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

    const INT_TYPE = 1;
    const FLOAT_TYPE = 2;
    const CHAR_TYPE = 3;
    const DATE_TYPE = 4;
    const TEXT_TYPE = 5;
    const HTML_TYPE = 6;
    const CATALOG_TYPE = 7;

    public $viewPath = '@app/views/event/';
    public $_value;
    public $eventID;

    public function instance($type = null, $eventID = null) {
        if (!empty($eventID))
            $this->eventID = $eventID;

        switch ($type) {
            case self::INT_TYPE:
                return new EventAttributeInt();
                break;
            case self::FLOAT_TYPE:
                return new EventAttributeFloat();
                break;
            case self::CHAR_TYPE:
                return new EventAttributeChar();
                break;
            case self::DATE_TYPE:
                return new EventAttributeInt();
                break;
            case self::TEXT_TYPE:
                return new EventAttributeText();
                break;
            case self::HTML_TYPE:
                return new EventAttributeText();
                break;
            case self::CATALOG_TYPE: break;
            default:
                break;
        }
    }

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

    public function getValue() {
        //print_r($this->instance($this->type_id)->findOne(['event_id' =>  $this->eventID, 'attribute_id' => $this->id])); die;
        return $this->instance($this->type_id)->findOne(['event_id' => $this->eventID, 'attribute_id' => $this->id])->value;
    }

    public function setValue($value) {
        return $this->value = $value;
    }

    public function getEventID() {
        return Yii::$app->controller->model->id;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if ($this->scenario == 'saveAttributeValue') {
            if (!$this->saveValue())
                return FALSE;
        }
        return true;
    }

    public function saveValue() {

        $model = $this->instance($this->type_id);
        if ($m = $model->findOne(['attribute_id' => $this->id, 'event_id' => $this->eventID])) {
            $model = $m;
        }
        if (empty($this->value)) {
            if ($this->required) {
                $this->addError($this->alias, Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => $this->name]));
                return FALSE;
            } else {
                $model->delete();
                return;
            }
        }
        $model->value = $this->value;
        $model->event_id = $this->eventID;
        $model->attribute_id = $this->id;

        if (!$model->save()) {
            $this->addError($this->alias, str_replace('Value', $this->name, $model->errors['value'][0]));
            return FALSE;
        }

        return TRUE;
//                print_r($tmpModel->type_id);
//                print_r($model->errors);
    }

}
