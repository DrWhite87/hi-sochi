<?php

namespace app\modules\user\controllers;

use Yii;
use app\modules\user\models\User;
use app\modules\user\models\Search;
use app\components\MyAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends MyAdminController {

    public function init() {
        parent::init();
        $this->model = new User;
        $this->searchModel = new Search;
        $this->module->setViewPath(Yii::getAlias('@app') . '\views\user');
    }

}
