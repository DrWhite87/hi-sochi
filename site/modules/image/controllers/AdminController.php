<?php

namespace app\modules\image\controllers;

use Yii;
use yii\web\Controller;

class AdminController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

}
