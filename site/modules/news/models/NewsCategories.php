<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "tbl_news_categories".
 *
 * @property integer $news_id
 * @property integer $category_id
 */
class NewsCategories extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%news_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['news_id', 'category_id'], 'required'],
            [['news_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'news_id' => Yii::t('model', 'News ID'),
            'category_id' => Yii::t('model', 'Category ID'),
        ];
    }
     
    
    public static function saveChange($data, $news_id) {
        
        self::deleteAll(['news_id' => $news_id]);
        
        if(is_array($data) && count($data) > 0)
            foreach ($data as $category_id){
                $model = new self();
                $model->category_id = $category_id;
                $model->news_id = $news_id;
                $model->save();
            }
    }
}
