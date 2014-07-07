<?php

namespace app\modules\event\models;

use Yii;
use app\components\behaviors\AliasBehavior;
use \app\modules\event\components\AttributeType;
use app\modules\event\models\attributes\EventAttributeInt,
    app\modules\event\models\attributes\EventAttributeChar,
    app\modules\event\models\attributes\EventAttributeText,
    app\modules\event\models\attributes\EventAttributeDate,
    app\modules\event\models\attributes\EventAttributeFloat;

/**
 * This is the model class for table "tbl_event_attributes".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property integer $type_id
 * @property integer $category_id
 * @property integer $value_id
 */
class EventAttribute extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            'alias' => [
                'class' => AliasBehavior::className(),
                'inAttribute' => 'name',
                'outAttribute' => 'alias',
                'translit' => true,
                'delimetr' => '_',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event_attributes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'alias', 'type_id', 'category_id'], 'required'],
            [['type_id', 'category_id'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['value'], 'safe', 'on' => 'saveAttributeValue'],
            [['required'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'name' => Yii::t('model', 'Name'),
            'alias' => Yii::t('model', 'Alias'),
            'type_id' => Yii::t('model', 'Type ID'),
            'category_id' => Yii::t('model', 'Category ID'),
            'required' => Yii::t('model', 'Required'),
        ];
    }

    /* relations */

    public function getCategory() {
        return $this->hasOne(EventCategory::className(), ['id' => 'category_id']);
    }

    public function getType() {
        return $this->hasOne(EventAttributeType::className(), ['id' => 'type_id']);
    }

    /* значение атрибута */

    public function categoryList() {
        return \yii\helpers\ArrayHelper::map(EventCategory::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name');
    }

    public function typeList() {
        return \yii\helpers\ArrayHelper::map(EventAttributeType::find()->select(['id', 'label'])->asArray()->all(), 'id', 'label');
    }

}
