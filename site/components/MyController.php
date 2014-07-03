<?php

namespace app\components;

use Yii;
use yii\base\InlineAction;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Controller;

/**
 * Controller is the base class of web controllers.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyController extends Controller {

    public $layout = 'main';
    public $model;
    public $searchModel;

    public function actions() {
        return [
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::className(),
                'testLimit' => 3,
                'minLength' => 3,
                'maxLength' => 3,
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(['Search' => Yii::$app->request->getQueryParams()]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($alias) {
        return $this->render('view', [
                    'model' => $this->findModelByAlias($alias),
        ]);
    }

    protected function findModelByAlias($alias) {
        if (($model = $this->model->findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
