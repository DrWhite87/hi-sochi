<?php

namespace app\modules\tags\models;

use Yii;

/**
 * This is the model class for table "tbl_tags".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 * @property string $module
 */
class Tags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('model', 'ID'),
            'name' => Yii::t('model', 'Name'),
            'frequency' => Yii::t('model', 'Frequency'),
            'module' => Yii::t('model', 'Module'),
        ];
    }

    /* мои методы */

    /**
     * Returns tag names and their corresponding weights.
     * Only the tags with the top weights will be returned.
     * @param integer the maximum number of tags that should be returned
     * @return array weights indexed by tag names.
     */
    public function findTagWeights($limit = 20) {
        $models = $this->findAll(array(
            'order' => 'frequency DESC',
            'limit' => $limit,
            'condition' => 'module=:module',
            'params' => [
                ':module' => \Yii::$app->controller->module->id,
            ]
        ));

        $total = 0;
        foreach ($models as $model)
            $total+=$model->frequency;

        $tags = array();
        if ($total > 0) {
            foreach ($models as $model)
                $tags[$model->name] = 8 + (int) (16 * $model->frequency / ($total + 10));
            ksort($tags);
        }
        return $tags;
    }

    /**
     * Suggests a list of existing tags matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of tags to be returned
     * @return array list of matching tag names
     */
    public function suggestTags($keyword, $limit = 20) {
        $tags = $this->findAll(array(
            'condition' => 'module=:module AND name LIKE :keyword',
            'order' => 'frequency DESC, Name',
            'limit' => $limit,
            'params' => array(
                ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
                ':module' => \Yii::$app->controller->module->id,
            ),
        ));
        $names = array();
        foreach ($tags as $tag)
            $names[] = $tag->name;
        return $names;
    }

    public static function string2array($tags) {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags) {
        return implode(', ', $tags);
    }

    public static function updateFrequency($oldTags, $newTags) {
        $oldTags = self::string2array($oldTags);
        $newTags = self::string2array($newTags);
        self::addTags(array_values(array_diff($newTags, $oldTags)));
        self::removeTags(array_values(array_diff($oldTags, $newTags)));
    }

    public static function addTags($tags) {
        self::updateAllCounters(['frequency' => 1], ['name' => $tags, 'module' => \Yii::$app->controller->module->id]);
        foreach ($tags as $name) {
            if (!self::findOne(['name' => $name])) {
                $tag = new self;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->module = \Yii::$app->controller->module->id;
                $tag->save();
            }
        }
    }

    public static function removeTags($tags) {
        if (empty($tags))
            return;
        self::updateAllCounters(['frequency' => -1], ['name' => $tags, 'module' => \Yii::$app->controller->module->id]);
        self::deleteAll('frequency<=0');
    }

}
