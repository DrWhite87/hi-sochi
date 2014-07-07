<?php

namespace app\modules\event\controllers;

use Yii;
use app\modules\event\models\Event;
use app\modules\event\models\Search;
use app\components\MyController;

class EventController extends MyController {

    public function init() {
        parent::init();
        $this->model = new Event;
        $this->searchModel = new Search;
    }
    
    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex() {
        $search = Yii::$app->request->getQueryParams();
        $search['notOverdue'] = true;
        $search['status'] = Event::ACTIVE;
        
        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(['Search' => $search]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    } 

}
