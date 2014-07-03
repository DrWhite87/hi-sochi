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
    
    const INT_TYPE = 1;
    const FLOAT_TYPE = 2;
    const CHAR_TYPE = 3;
    const DATE_TYPE = 4;
    const TEXT_TYPE = 5;
    const HTML_TYPE = 6;
    const CATALOG_TYPE = 7;
    
    public $viewPath = '@app/views/event/';
    
    
    
    public static function instance($type = null) {
        switch ($type) {
            case self::INT_TYPE:   
                return new EventAttributeInt();
                break;
            case self::FLOAT_TYPE:   
                return new EventAttributeFloat();
                break;
            case self::CHAR_TYPE:   
                return new EventAttributeChar();
                break;
            case self::DATE_TYPE:   
                return new EventAttributeInt();
                break;
            case self::TEXT_TYPE:   
                return new EventAttributeText();
                break;
            case self::HTML_TYPE:   
                return new EventAttributeText();
                break;
            case self::CATALOG_TYPE:                break;
            default:
                break;
        }
    }
    
    public function render($view = null, array $data = null) {
        $v =  new \yii\web\View();
        return $v->render($this->viewPath . $view, $data);
    }
    
    public function renderForm($view, array $data){}
    
    
}
