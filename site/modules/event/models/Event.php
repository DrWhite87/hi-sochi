<?php

namespace app\modules\event\models;

use Yii;
use \yii\helpers\ArrayHelper;
use app\components\helpers\MyHelper;
use app\components\behaviors\AliasBehavior;
use app\components\behaviors\BETimeBehavior;
use app\components\behaviors\UploadImagesBehavior;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use app\modules\tags\models\Tags;
use app\modules\image\models\Image;

/**
 * This is the model class for table "tbl_events".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $descr
 * @property integer $date_begin
 * @property integer $date_end
 * @property integer $category_id
 * @property integer $image_id
 * @property integer $status
 */
class Event extends \yii\db\ActiveRecord {

    const ACTIVE = 1;
    const DRAFT = 2;
    const ARCHIVE = 3;

    private $_category;
    //public $category;
    
    public $options = [
        'pageSize' => 5,
    ];

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
                'attributes' => ['date_begin', 'date_end'],
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
            ],
            'uploadImages' => [
                'class' => UploadImagesBehavior::className(),
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
                    'image_id' => 'image',
                ],
                'path' => Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/event/',
                'imageModel' => 'app\modules\image\models\Image',
                'imageModelRelationKey' => 'element_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%events}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['alias', 'title', 'date_begin', 'category_id'], 'required'],
            [['descr'], 'string'],
            [['date_begin', 'date_end', 'category_id', 'image_id', 'status'], 'integer'],
            [['alias', 'title'], 'string', 'max' => 255],
            [['image'], 'file', 'types' => ['jpg', 'png', 'jpeg']],
            [['date_end'], 'compare', 'operator' => '>', 'compareAttribute' => 'date_begin'],
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
            'alias' => Yii::t('model', 'Alias'),
            'title' => Yii::t('model', 'Title'),
            'descr' => Yii::t('model', 'Descr'),
            'date_begin' => Yii::t('model', 'Date Begin'),
            'date_end' => Yii::t('model', 'Date End'),
            'category_id' => Yii::t('model', 'Category ID'),
            'image' => Yii::t('model', 'Image'),
            'status' => Yii::t('model', 'Status'),
            'tags' => Yii::t('model', 'Tags'),
        ];
    }

    /* валидация */

    public function normalizeTags($attribute, $params) {
        $this->tags = Tags::array2string(array_unique(Tags::string2array($this->tags)));
    }

    /* relations */

    /* дополнительные атрибуты события */

    public function getImage() {
        // News has_one Image
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
    

    public function setImage($value) {
        $this->image = Image::findOne($this->image_id);
    }

    public function getCategory() {
        return $this->hasOne(EventCategory::className(), ['id' => 'category_id']);
    }
    
    public function setCategory($value) {
        $this->category = $value;
    }
    
    public function getComment() {
        // News has_many comments
        return new \app\modules\comment\models\Comment;
    }
    
    
    /* ------------------------ */
    
    private $_oldTags;

    public function afterFind() {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }
    

    public function afterSave($insert) {
        parent::afterSave($insert);
        Tags::updateFrequency($this->_oldTags, $this->tags);       
       
        return TRUE;
    }

    public function beforeDelete() {
        parent::beforeDelete();

        Image::deleteImages('event', $this->id);
        \app\modules\comment\models\Comment::deleteAll(['element_id' => $this->id]);
        Tags::removeTags(Tags::string2array($this->tags));

        return true;
    }

    /* методы помошники */

    public function categoryList() {
        return ArrayHelper::map(EventCategory::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name');
    }

    public static function statusList() {
        return ArrayHelper::map(EventLookup::find()->select(['id', 'name'])->where(['type' => 'eventStatus'])->orderBy('position')->asArray()->all(), 'id', 'name');
    }

    public function imageUrl($size = null) {        
        return Yii::getAlias('@web') . '/' . Yii::$app->params['imageUploadPath'] . '/event/' . $size . '/' . $this->image->name;
    }
    
    public function findByAlias($alias) {
        return self::findOne(['alias' => $alias]);
    }

}
