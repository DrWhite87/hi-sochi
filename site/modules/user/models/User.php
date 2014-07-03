<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $ip
 * @property string $role
 * @property string $authKey
 * @property string $accessToken
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email', 'first_name', 'password', 'ip'], 'required'],
            [['username', 'email', 'first_name', 'last_name'], 'string', 'max' => 150],
            [['password'], 'string', 'max' => 250],
            [['ip', 'role'], 'string', 'max' => 20],
            [['authKey', 'accessToken'], 'string', 'max' => 100],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'username' => Yii::t('model', 'Username'),
            'email' => Yii::t('model', 'Email'),
            'first_name' => Yii::t('model', 'First Name'),
            'last_name' => Yii::t('model', 'Last Name'),
            'password' => Yii::t('model', 'Password'),
            'ip' => Yii::t('model', 'Ip'),
            'role' => Yii::t('model', 'Role'),
            'authKey' => Yii::t('model', 'Auth Key'),
            'accessToken' => Yii::t('model', 'Access Token'),
        ];
    }

    /* */
    /*
     * @inheritdoc
     */

    public static function findIdentity($id) {
        if ($user = self::findOne($id)) {
            return $user;
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token) {
        if ($user = self::findOne(['accessToken' => $token])) {
            return $user;
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        if ($user = self::findOne(['username' => $username])) {
            return $user;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === md5(md5($password));
    }

}
