<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl__tmp_image".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $size
 * @property string $ext
 * @property string $module
 */
class TmpImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_tmp_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'size', 'ext', 'module'], 'required'],
            [['size'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 10],
            [['ext'], 'string', 'max' => 5],
            [['module'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'ext' => Yii::t('app', 'Ext'),
            'module' => Yii::t('app', 'Module'),
        ];
    }
}
