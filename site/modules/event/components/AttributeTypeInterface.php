<?php

namespace app\modules\event\components;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttributeTypeInterface
 *
 * @author d.batminov
 */
interface AttributeTypeInterface {
    
    // fontend вывод атрибутов
    public function render();
    // вывод атрибутов в форму
    public function formRender();
        
}
