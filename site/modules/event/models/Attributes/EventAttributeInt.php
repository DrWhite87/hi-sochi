<?php

namespace app\modules\event\models\attributes;

use Yii;

/**
 * This is the model class for table "tbl_event_attribute_int".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $attribute_id
 * @property integer $value
 */
class EventAttributeInt extends \app\modules\event\components\AttributeType {
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event_attribute_int}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['event_id', 'attribute_id', 'value'], 'required'],
            [['value'], 'setDate'],
            [['event_id', 'attribute_id', 'value'], 'integer']
        ];
    }
    
    public function setDate($attribute, $params) {
        if(preg_match('#\d{2}/\d{2}/\d{4}#', $this->value)){
            $this->value = \app\components\helpers\MyHelper::formatDate($this->value);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'event_id' => Yii::t('model', 'Event ID'),
            'attribute_id' => Yii::t('model', 'Attribute ID'),
            'value' => Yii::t('model', 'Value'),
        ];
    }
}
