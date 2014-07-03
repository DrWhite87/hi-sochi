<?php

class ModuleUrlManager {

    static function collectRules() {
        //если в приложении определены модули
        if(!empty(Yii::app()->modules)) {
            $cache = Yii::app()->getCache();
            //получаем список модулей
            foreach (Yii::app()->modules as $moduleName => $config) {                
                $urlRules = false;
                if($cache) {
                    $urlRules = $cache->get('module.urls.' . $moduleName);
                }
                
                if($urlRules === false) {
                    $urlRules = array();
                    $module = Yii::app()->getModule($moduleName);
                    if(isset($module->urlRules))
                        $urlRules = $module->urlRules;
                }
                if($cache)
                    $cache->set ('module.urls.' . $moduleName, $urlRules);
                //проверяем существует ли свойство urlRules
                if(!empty($urlRules)) {
                    //если да, добавляем к остальным правилам
                    Yii::app()->getUrlManager()->addRules($urlRules);
                }
            }
        }
        return true;
    }

}
