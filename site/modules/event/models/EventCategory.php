<?php

namespace app\modules\event\models;

use Yii;
use app\components\behaviors\AliasBehavior;
/**
 * This is the model class for table "tbl_event_categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $descr
 */
class EventCategory extends \yii\db\ActiveRecord {

    //protected $_attributes;
    
    public function behaviors() {
        return [
            'alias' => [
                'class' => AliasBehavior::className(),
                'inAttribute' => 'name',
                'outAttribute' => 'alias',
                'translit' => true
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'alias'], 'required'],
            [['descr'], 'string'],
            [['name', 'alias'], 'string', 'max' => 255]
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
            'descr' => Yii::t('model', 'Descr'),
        ];
    }

    /* возвращает атрибуты категории */
    
    public function getEvents() {
        return $this->hasMany(Event::className(), ['category_id' => 'id']);
    }
    
    public static function findByAlias($alias) {
        return self::findOne(['alias' => $alias]);
    }
}
