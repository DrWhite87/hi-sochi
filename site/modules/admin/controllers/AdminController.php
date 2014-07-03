<?php

namespace app\modules\admin\controllers;

use app\components\MyAdminController;

class AdminController extends MyAdminController {

    public function actionIndex() {
        return $this->render('/index');
    }

}
