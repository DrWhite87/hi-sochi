<?php

namespace app\modules\event\controllers;

use Yii;
use yii\web\Controller;
use app\modules\event\models\Event;
use app\modules\event\models\Search;
use app\components\MyAdminController;
use yii\filters\AccessControl;

class AdminController extends MyAdminController {

    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->model = new Event;
        $this->searchModel = new Search;
        $this->module->setViewPath(Yii::getAlias('@app') . '\views\event');
    }

    public function actionIndex($category) {
        $search = Yii::$app->request->getQueryParams();
        $categoryModel = \app\modules\event\models\EventCategory::findByAlias($category);
        $search['category_id'] = $categoryModel->id;

        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(['Search' => $search]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'categoryModel' => $categoryModel,
        ]);
    }

    /**
     * Creates a new EventAttribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category) {
        $model = new $this->model;
        $model->category_id = \app\modules\event\models\EventCategory::findOne(['alias' => $category])->id;

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save())
                return $this->redirect('admin/events/' . $category);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EventAttribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($category, $id) {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post())) {
//            $transaction = Yii::$app->db->beginTransaction();
//            if ($model->save()) {
//                $transaction2 = \Yii::$app->db->beginTransaction();
//                $arrtErrors = \app\modules\event\models\EventAttribute::saveValue($model->moreAttributes, $model->id);
//                if ($arrtErrors === TRUE) {
//                    $transaction2->commit();
//                    $transaction->commit();
//                    return $this->redirect('admin/events/' . $category);
//                } else {
//                    $transaction2->rollBack();
//                    $model->addError('moreAttributes', $arrtErrors);
//                }
//            } else {
//                $transaction->rollBack();
//            }
//        }
//        return $this->render('update', [
//                    'model' => $model,
//                    'category' => $category,
//        ]);
//    }

    public function actionUpdate($category, $id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('admin/events/' . $category);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'category' => $category,
            ]);
        }
    }

}
