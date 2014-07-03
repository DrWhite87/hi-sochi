<?php

namespace app\modules\news;

class NewsModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\news\controllers';
    public $defaultRoute = 'news';

    public function init()
    {
        parent::init();
    }
}
