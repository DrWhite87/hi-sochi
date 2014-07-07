<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\event\components;


use app\modules\event\models\attributes\EventAttributeInt,
    app\modules\event\models\attributes\EventAttributeChar,
    app\modules\event\models\attributes\EventAttributeText,
    app\modules\event\models\attributes\EventAttributeDate,
    app\modules\event\models\attributes\EventAttributeFloat;
/**
 * Description of AttributeTypeFactory
 *
 * @author d.batminov
 */
class AttributeType extends \yii\db\ActiveRecord{
    
    public $viewPath = '@app/views/event/';
    public $formViewPath = '@app/modules/event/views/';
    
    public function render($view = null, array $data = null) {
        $v =  new \yii\web\View();
        return $v->render($this->viewPath . $view, $data);
    }
    
    public function renderForm($view = null, array $data = null) {
        $v =  new \yii\web\View();
        return $v->render($this->formViewPath . $view, $data);        
    }    
}