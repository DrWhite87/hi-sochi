<?php

namespace app\modules\event\models;

use Yii;

/**
 * This is the model class for table "tbl_event_attribute_types".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 */
class EventAttributeType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event_attribute_types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'label'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'name' => Yii::t('model', 'Name'),
            'label' => Yii::t('model', 'Label'),
        ];
    }
}
