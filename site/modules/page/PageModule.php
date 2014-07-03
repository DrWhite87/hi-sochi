<?php

namespace app\modules\page;

class PageModule extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\page\controllers';
    public $defaultRoute = 'page';

    public function init() {
        parent::init();
    }

}
