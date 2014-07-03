<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "tbl_news_lookup".
 *
 * @property integer $id
 * @property integer $code
 * @property string $name
 * @property string $type
 * @property integer $position
 */
class NewsLookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_lookup}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'type', 'position'], 'required'],
            [['code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'position' => Yii::t('app', 'Position'),
        ];
    }
}
