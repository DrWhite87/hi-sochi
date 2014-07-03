<?php

namespace app\modules\page\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\behaviors\AliasBehavior;
use app\components\behaviors\BETimeBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property integer $created
 * @property integer $updated
 * @property integer $weight
 * @property integer $status
 */
class Page extends ActiveRecord {

    public function behaviors() {
        return [
            'alias' => [
                'class' => AliasBehavior::className(),
                'inAttribute' => 'title',
                'outAttribute' => 'alias',
                'translit' => true
            ],
            'BETime' => [
                'class' => BETimeBehavior::className(),
                'attributes' => ['created', 'updated'],
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'alias', 'content'], 'required'],
            [['content'], 'string'],
            [['weight', 'status'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'title' => Yii::t('model', 'Title'),
            'alias' => Yii::t('model', 'Alias'),
            'content' => Yii::t('model', 'Content'),
            'created' => Yii::t('model', 'Created'),
            'updated' => Yii::t('model', 'Updated'),
            'weight' => Yii::t('model', 'Weight'),
            'status' => Yii::t('model', 'Status'),
        ];
    }

    /* Мои методы */

    public function findByAlias($alias) {
        return Page::findOne(['alias' => $alias]);
    }

    public function beforeValidate() {
        if (empty($this->alias)) {
            $this->alias = MyHelper::str2url($this->title);
        }
        return true;
    }

}
