<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "tbl_news_image".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $size
 * @property string $ext
 * @property integer $news_id
 */
class NewsImage extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%news_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'type', 'size'], 'required'],
            [['size', 'news_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 10],
            [['ext'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'ext' => Yii::t('app', 'Ext'),
            'news_id' => Yii::t('app', 'News ID'),
        ];
    }

    /* relations */
    public function getNews() {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }
    
    public static function deleteImages($news_id) {
        $models = self::findAll(['news_id' => $news_id]);
        
        foreach ($models as $model) {
            unlink(Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/news/' . $model->name);
            unlink(Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/news/small/' . $model->name);
            unlink(Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/news/medium/' . $model->name);
            $model->delete();
        }
    }

}
