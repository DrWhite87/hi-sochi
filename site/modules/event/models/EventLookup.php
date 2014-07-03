<?php

namespace app\modules\event\models;

use Yii;

/**
 * This is the model class for table "tbl_event_lookup".
 *
 * @property integer $id
 * @property integer $code
 * @property string $name
 * @property string $type
 * @property integer $position
 */
class EventLookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event_lookup}}';
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
            'id' => Yii::t('model', 'ID'),
            'code' => Yii::t('model', 'Code'),
            'name' => Yii::t('model', 'Name'),
            'type' => Yii::t('model', 'Type'),
            'position' => Yii::t('model', 'Position'),
        ];
    }
}
