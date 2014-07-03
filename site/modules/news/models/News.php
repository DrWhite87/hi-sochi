<?php

namespace app\modules\news\models;

use Yii;
use \yii\helpers\ArrayHelper;
use app\components\helpers\MyHelper;
use app\components\behaviors\AliasBehavior;
use app\components\behaviors\BETimeBehavior;
use app\components\behaviors\NewsUploadImagesBehavior;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use app\modules\tags\models\Tags;

/**
 * This is the model class for table "tbl_news".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $anons
 * @property integer $anons_image_id
 * @property string $content
 * @property string $tags
 * @property integer $created
 * @property integer $updated
 * @property integer $user_id
 * @property string $source
 * @property integer $image_id
 * @property integer $head
 * @property integer $status
 * @property integer $begin_active
 * @property integer $end_active
 */
class News extends ActiveRecord {
    
    const ACTIVE = 1;
    const DRAFT = 2;
    const ARCHIVE = 3;

    public $anons_image;
    public $content_image;
    public $options = [
        'pageSize' => 5,
    ];
    public $category;
    private $_categories;

    public function behaviors() {
        return [
            'alias' => [
                'class' => AliasBehavior::className(),
                'inAttribute' => 'title',
                'outAttribute' => 'alias',
                'translit' => true
            ],
            'BETime' => [
                'class' => BETimeBehavior::className(),
                'attributes' => ['begin_active', 'end_active'],
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
            ],            
            'uploadImages' => [
                'class' => NewsUploadImagesBehavior::className(),
                'bigImage' => [
                    'maxWidth' => '800',
                    'maxHeight' => '600',
                ],
                'mediumImage' => [
                    'employ' => true,
                    'maxWidth' => '400',
                    'maxHeight' => '300',
                ],
                'smallImage' => [
                    'employ' => true,
                    'maxWidth' => '200',
                    'maxHeight' => '150',
                ],
                'attributes' => [
                    'image_id' => 'content_image',
                    'anons_image_id' => 'anons_image',
                ],
                'path' => Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/news/',
                'imageModel' => 'app\modules\news\models\NewsImage',
                'imageModelRelationKey' => 'news_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'status', 'begin_active', 'categories'], 'required'],
            [['anons', 'content'], 'string'],
            [['user_id', 'image_id', 'anons_image_id', 'head', 'status'], 'integer'],
            //[['begin_active', 'end_active'], 'date', 'format' => 'd/m/Y'],
            [['begin_active', 'end_active'], 'integer'],
            [['title', 'alias', 'tags', 'source'], 'string', 'max' => 255],
            [['anons_image', 'content_image'], 'file', 'types' => ['jpg', 'png', 'jpeg']],
            [['end_active'], 'compare', 'operator' => '>', 'compareAttribute' => 'begin_active'],
            [['tags'], 'match', 'pattern' => '/^[\w\s,]+$/u', 'message' => 'В тегах можно использовать только буквы.'],
            [['tags'], 'normalizeTags'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'title' => Yii::t('model', 'Title'),
            'alias' => Yii::t('model', 'Alias'),
            'anons' => Yii::t('model', 'Anons'),
            'anons_image' => Yii::t('model', 'Anons Image'),
            'content' => Yii::t('model', 'Content'),
            'tags' => Yii::t('model', 'Tags'),
            'created' => Yii::t('model', 'Created'),
            'updated' => Yii::t('model', 'Updated'),
            'user_id' => Yii::t('model', 'Author'),
            'source' => Yii::t('model', 'Source'),
            'content_image' => Yii::t('model', 'Content Image'),
            'head' => Yii::t('model', 'Head'),
            'status' => Yii::t('model', 'Status'),
            'begin_active' => Yii::t('model', 'Begin Active'),
            'end_active' => Yii::t('model', 'End Active'),
            'categories' => Yii::t('model', 'Categories'),
        ];
    }

    /* валидация */

    public function normalizeTags($attribute, $params) {
        $this->tags = Tags::array2string(array_unique(Tags::string2array($this->tags)));
    }

    /* relations */

    public function getAnonsImage() {
        // News has_one Image
        return $this->hasOne(NewsImage::className(), ['id' => 'anons_image_id']);
    }

    public function getContentImage() {
        // News has_one Image
        return $this->hasOne(NewsImage::className(), ['id' => 'image_id']);
    }

    public function getComments() {
        // News has_many comments
        return $this->hasMany(\app\modules\comment\models\Comment::className(), ['element_id' => 'id']);
    }

    public function getComment() {
        // News has_many comments
        return new \app\modules\comment\models\Comment;
    }

    public function getNewsCategories() {
        return $this->hasMany(NewsCategories::className(), ['news_id' => 'id']);
    }
    
    public function getLookup() {
        return $this->hasOne(NewsLookup::className(), ['id' => 'status']);
    }

    public function getCategories() {
        // News many_many categories
        return $this->hasMany(NewsCategory::className(), ['id' => 'category_id'])->via('newsCategories');
    }

    public function getAuthor() {
        // News many_many categories
        return $this->hasOne(\app\modules\user\models\User::className(), ['id' => 'user_id']);
    }
    
    public function setCategories($value) {
        return $this->categories = $value;
    }
    
    

    /*
      public function getCategories() {
      // News has_many categories
      return $this->hasMany(NewsCategory::className(), ['news_id' => 'id']);
      }
     */
    /* Мои методы */

    public function anonsImageUrl($size = null) {
        return Yii::getAlias('@web') . '/' . Yii::$app->params['imageUploadPath'] . '/news/' . $size . '/' . $this->anonsImage->name;
    }

    public function contentImageUrl($size = null) {
        return Yii::getAlias('@web') . '/' . Yii::$app->params['imageUploadPath'] . '/news/' . $size . '/' . $this->contentImage->name;
    }

    public function findByAlias($alias) {
        return News::findOne(['alias' => $alias]);
    }

    public static function statusList() {
        return ArrayHelper::map(NewsLookup::find()->select(['id', 'name'])->where(['type' => 'newsStatus'])->orderBy('position')->asArray()->all(), 'id', 'name');
    }
    
    public function categoryList() {
        return ArrayHelper::map(NewsCategory::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name');
    }

    /*  */
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->user_id = \Yii::$app->user->identity->id; 
        if(Yii::$app->user->identity->role == \app\modules\user\models\User::ROLE_USER && $this->isNewRecord)
            $this->status = self::DRAFT;
        return true;
    }

    public function afterSave($insert) {
        parent::afterSave($insert);
        Tags::updateFrequency($this->_oldTags, $this->tags);
        NewsCategories::saveChange($this->categories, $this->id);        
    }
    
    public function beforeDelete() {
        parent::beforeDelete();
        
        NewsImage::deleteImages($this->id);
        NewsCategories::deleteAll(['news_id' => $this->id]);
        \app\modules\comment\models\Comment::deleteAll(['element_id' => $this->id]);
        Tags::removeTags(Tags::string2array($this->tags));        
        
        return true;
    }

    private $_oldTags;

    public function afterFind() {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

}
