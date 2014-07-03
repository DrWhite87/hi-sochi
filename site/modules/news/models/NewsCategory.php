<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "tbl_news_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $descr
 * @property integer $active
 */
class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'descr'], 'required'],
            [['descr'], 'string'],
            [['active'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'alias' => Yii::t('app', 'Alias'),
            'descr' => Yii::t('app', 'Descr'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
    
    public function afterSave($insert) {
        parent::afterSave($insert);
        
    }
}
