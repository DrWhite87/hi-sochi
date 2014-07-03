<?php

namespace app\modules\event\models\attributes;

use Yii;

/**
 * This is the model class for table "tbl_event_attribute_text".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $attribute_id
 * @property string $value
 */
class EventAttributeText extends \app\modules\event\components\AttributeType {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event_attribute_text}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['event_id', 'attribute_id', 'value'], 'required'],
            [['event_id', 'attribute_id'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'event_id' => Yii::t('model', 'Event ID'),
            'attribute_id' => Yii::t('model', 'Attribute Info ID'),
            'value' => Yii::t('model', 'Value'),
        ];
    }

}
