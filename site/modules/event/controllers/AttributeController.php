<?php

namespace app\modules\event\controllers;

use Yii;
use app\modules\event\models\EventAttribute;
use app\modules\event\models\AttributeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminEventAttributesController implements the CRUD actions for EventAttribute model.
 */
class AttributeController extends \app\components\MyAdminController {

    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->model = new EventAttribute;
        $this->searchModel = new AttributeSearch;
        $this->module->setViewPath(Yii::getAlias('@app') . '\views\event\admin');
    }

    /**
     * Lists all EventAttribute models.
     * @return mixed
     */
    public function actionIndex($category) {

        $search = Yii::$app->request->getQueryParams();
        $categorModel = \app\modules\event\models\EventCategory::findByAlias($category);
        $search['category_id'] = $categorModel->id;
        
        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(['AttributeSearch' => $search]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'categoryModel' => $categorModel,
        ]);
    }

    /**
     * Creates a new EventAttribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category) {
        $model = new EventAttribute;
        $model->category_id = \app\modules\event\models\EventCategory::findOne(['alias' => $category])->id;
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
                return $this->redirect('admin/event-category-attributes/' . $category);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'category' => $category,
            ]);
        }
    }

    /**
     * Updates an existing EventAttribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($category, $id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('admin/event-category-attributes/' . $category);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'category' => $category,
            ]);
        }
    }

}
