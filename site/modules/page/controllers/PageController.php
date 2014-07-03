<?php

namespace app\modules\page\controllers;

use Yii;
use app\modules\page\models\Page;
use app\modules\page\models\Search;
use app\components\MyController;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends MyController {
    
    public function init() {
        parent::init();
        $this->model = new Page;
        $this->searchModel = new Search;
    }    

}
