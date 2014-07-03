<?php

namespace app\modules\tags\controllers;

use yii\web\Controller;

class AdminController extends \app\components\MyAdminController {

    public function actionIndex() {
        return $this->render('index');
    }

}
