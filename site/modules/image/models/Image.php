<?php

namespace app\modules\image\models;

use Yii;

/**
 * This is the model class for table "tbl_images".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $size
 * @property string $module
 * @property integer $element_id
 */
class Image extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'module'], 'required'],
            [['size', 'element_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 10],
            [['module'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'name' => Yii::t('model', 'Name'),
            'type' => Yii::t('model', 'Type'),
            'size' => Yii::t('model', 'Size'),
            'module' => Yii::t('model', 'Module'),
            'element_id' => Yii::t('model', 'Element ID'),
        ];
    }

    public static function deleteImages($module, $element_id) {
        $models = self::findAll(['element_id' => $element_id]);

        foreach ($models as $model) {
            unlink(Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/' . $module . '/' . $model->name);
            unlink(Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/' . $module . '/small/' . $model->name);
            unlink(Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/' . $module . '/medium/' . $model->name);
            $model->delete();
        }
    }

}
