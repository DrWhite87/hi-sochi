<?php

namespace app\modules\comment;

class CommentModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\comment\controllers';
    public $defaultRoute = 'comment';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
