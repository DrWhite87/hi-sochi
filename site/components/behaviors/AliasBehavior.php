<?php

namespace app\components\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\components\helpers\transliterator\TransliteratorHelper;
use yii\helpers\Inflector;


class AliasBehavior extends Behavior {

    public $inAttribute = 'title';
    public $outAttribute = 'alias';
    public $translit = true;
    public $delimetr = '-';

    public function events() {        
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getAlias',
        ];
    }

    public function getAlias($event) {        
        if (empty($this->owner->{$this->outAttribute})) {
            $this->owner->{$this->outAttribute} = $this->generateAlias($this->owner->{$this->inAttribute});
        } else {
            $this->owner->{$this->outAttribute} = $this->generateAlias($this->owner->{$this->outAttribute});
        }
    }

    private function generateAlias($alias) {
        $alias = $this->slugify($alias);
        if ($this->checkUniqueAlias($alias)) {
            return $alias;
        } else {
            for ($suffix = 2; !$this->checkUniqueAlias($newAlias = $alias . $this->delimetr . $suffix); $suffix++) {}
            return $newAlias;
        }
    }

    private function slugify($alias) {
        if ($this->translit) {
            $aliasArr = explode('/', $alias);
            foreach ($aliasArr as $key=>$value) {
                $aliasArr[$key] = Inflector::slug(TransliteratorHelper::process($value), $this->delimetr, true);
            }
            return implode('/', $aliasArr);
        } else {
            return $this->alias($alias, $this->delimetr, true);
        }
    }

    private function alias($string, $replacement = '-', $lowercase = true) {
        $string = preg_replace('/[^\p{L}\p{Nd}/] /u', $replacement, $string);
        $string = trim($string, $replacement);
        return $lowercase ? strtolower($string) : $string;
    }

    private function checkUniqueAlias($alias) {
        $pk = $this->owner->primaryKey();
        $pk = $pk[0];

        $condition = $this->outAttribute . ' = :outAttribute';
        $params = [ ':outAttribute' => $alias];
        if (!$this->owner->isNewRecord) {
            $condition .= ' and ' . $pk . ' != :pk';
            $params[':pk'] = $this->owner->{$pk};
        }

        return !$this->owner->find()
                        ->where($condition, $params)
                        ->one();
    }

}
