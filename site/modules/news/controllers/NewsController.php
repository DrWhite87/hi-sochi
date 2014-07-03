<?php

namespace app\modules\news\controllers;

use Yii;
use app\modules\news\models\News;
use app\modules\news\models\NewsComment;
use app\modules\news\models\Search;
use app\components\MyController;

class NewsController extends MyController {

    public function init() {
        parent::init();
        $this->model = new News;
        $this->searchModel = new Search;
    }
    
    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex() {
        $search = Yii::$app->request->getQueryParams();
        $search['notOverdue'] = true;
        $search['status'] = News::ACTIVE;
        
        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(['Search' => $search]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }    

}
