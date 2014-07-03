<?php

namespace app\modules\comment\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $content
 * @property integer $created
 * @property integer $status
 * @property integer $element_id
 * @property string $module
 */
class Comment extends \yii\db\ActiveRecord {

    public $verifyCode;
    public static $pageSize = 10;

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['user_name', 'user_email'], 'string', 'max' => 150],
            [['user_email'], 'email'],
            [['verifyCode'], 'captcha', 'on' => 'captchaRequired', 'captchaAction' => 'news/news/captcha', 'skipOnEmpty' => !Yii::$app->user->isGuest || !\yii\captcha\Captcha::checkRequirements()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'user_id' => Yii::t('model', 'User ID'),
            'user_name' => Yii::t('model', 'User Name'),
            'user_email' => Yii::t('model', 'User Email'),
            'content' => Yii::t('model', 'Content'),
            'created' => Yii::t('model', 'Created'),
            'status' => Yii::t('model', 'Status'),
            'element_id' => Yii::t('model', 'Element ID'),
            'module' => Yii::t('model', 'Module'),
        ];
    }

    public function getAuthor() {
        // News many_many categories
        return $this->hasOne(\app\modules\user\models\User::className(), ['id' => 'user_id']);
    }

    // GOTO
    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (\Yii::$app->user->isGuest) {
            $this->user_id = 0;
            $this->created = time();
            if (empty($this->user_name)) {
                $this->user_name = "Гость";
            }
        } else {
            $this->user_id = \Yii::$app->user->identity->id;
            $this->user_email = null;
            $this->user_name = null;
        }

        return true;
    }

}
