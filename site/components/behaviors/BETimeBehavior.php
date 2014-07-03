<?php

namespace app\components\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\components\helpers\MyHelper;


class BETimeBehavior extends Behavior {

    public $attributes = ['begin_active', 'end_active'];

    public function events() {        
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'setTimeIfEmpty',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'setTime',
        ];
    }

    public function setTime($event){        
        foreach ($this->attributes as $atribute){
            if (!empty($this->owner->{$atribute}))                
                $this->owner->{$atribute} = MyHelper::formatDate($this->owner->{$atribute});
            else 
                $this->owner->{$atribute} = null;
        }
    }
    
    public function setTimeIfEmpty($event){
        if (empty($this->owner->{$this->attributes[0]}))
            $this->owner->{$this->attributes[0]} = date('d/m/Y', time());
    }
    
    public function getTime($event){
        foreach ($this->attributes as $atribute){
            if(!empty($this->owner->{$atribute}))
                $this->owner->{$atribute} = date('d/m/Y', $this->owner->{$atribute});
        }
    }
}
