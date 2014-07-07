<?php

namespace app\modules\news\controllers;

use Yii;
use app\modules\news\models\News;
use app\modules\news\models\Search;
use app\components\MyAdminController;
use yii\filters\AccessControl;

/**
 * AdminController implements the CRUD actions for News model.
 */
class AdminController extends MyAdminController {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => 'app\components\AccessRule' // OUR OWN RULE
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['error'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['user'],
                        'actions' => ['index', 'create', 'update', 'delete'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'create' => ['get', 'post'],
                    'update' => ['get', 'put', 'post'],
                    'delete' => ['post', 'delete'],
                ],
            ],
        ];
    }

    public function init() {
        parent::init();
        $this->model = new News;
        $this->searchModel = new Search;
    }

}
