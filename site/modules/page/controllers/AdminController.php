<?php

namespace app\modules\page\controllers;

use Yii;
use app\modules\page\models\Page;
use app\modules\page\models\Search;
use app\components\MyAdminController;
use yii\web\ForbiddenHttpException;
/**
 * PageController implements the CRUD actions for Page model.
 */
class AdminController extends MyAdminController {
    
    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->model = new Page;
        $this->searchModel = new Search;
        $this->module->setViewPath(Yii::getAlias('@app') . '\views\page');
    }

}
