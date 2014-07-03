<?php

namespace app\modules\event\controllers;

use Yii;
use app\modules\event\models\EventCategory;
use app\modules\event\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminEventAttributesController implements the CRUD actions for EventAttribute model.
 */
class CategoryController extends \app\components\MyAdminController {

    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->model = new EventCategory;
        $this->searchModel = new CategorySearch;
        $this->module->setViewPath(Yii::getAlias('@app') . '\views\event\admin');
    }    
}
