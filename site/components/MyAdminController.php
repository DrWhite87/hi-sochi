<?php

namespace app\components;

use Yii;
use yii\base\InlineAction;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\assets\AppAsset;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Controller is the base class of web controllers.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyAdminController extends Controller {
    
    public $model;
    public $searchModel;
    
    public function init() {
        parent::init();
        Yii::$app->errorHandler->errorAction = 'page/admin/error';        
        $this->module->setLayoutPath(Yii::getAlias('@app') . '\modules\admin\views\layouts');        
        $this->module->setViewPath(Yii::getAlias('@app') . '\modules\\' . $this->module->id . '\views');
        $this->layout = 'admin';
    }
    
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'image-upload' => [
                'class' => \app\components\extentions\imperavi\actions\UploadAction::className(),
                'path' => Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/' . Yii::$app->module->id . '/',
                'url' => Yii::getAlias('@web') . '/' . Yii::$app->params['imageUploadPath'] . '/' . Yii::$app->module->id . '/',
                'maxSize' => 1000000,
            ],
            'get' => [
                'class' => \app\components\extentions\imperavi\actions\GetAction::className(),
                'path' => Yii::getAlias('@webroot') . '/' . Yii::$app->params['imageUploadPath'] . '/' . Yii::$app->module->id . '/',
                'url' => Yii::getAlias('@web') . '/' . Yii::$app->params['imageUploadPath'] . '/' . Yii::$app->module->id . '/',
                'options' => [  // See FileHelper::findFiles() $options argument.
                    'only' => ['/*.jpg']
                ]
            ],
        ];
    }
    
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
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /* List */
    public function actionIndex() {        
        $param = Yii::$app->request->getQueryParams();
                
        $searchModel = $this->searchModel;
        
        if(Yii::$app->user->identity->role == \app\modules\user\models\User::ROLE_USER){
            $param['CategorySearch']['user_id'] = Yii::$app->user->identity->id;
        }
        
        $dataProvider = $searchModel->search($param);

        return $this->render('/index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /* Create */    
    public function actionCreate() {
        $model = $this->model;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('admin/' . $this->module->id);
        } else {           
            print_r($model->errors);
            return $this->render('/create', [
                        'model' => $model,
            ]);
        }
    }

    /* Update */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('admin/' . $this->module->id);
        } else {
            print_r($model->errors);
            return $this->render('/update', [
                        'model' => $model,
            ]);
        }
    }

    /* Delete */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /* Find model */
    protected function findModel($id) {
        if (($model = $this->model->findOne($id)) !== null) {
            if(Yii::$app->user->identity->role == \app\modules\user\models\User::ROLE_USER && $model->user_id != Yii::$app->user->identity->id){
                throw new \yii\web\ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
            }
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /* Find model by alias */     
    protected function findModelByAlias($alias) {
        if (($model = $this->model->findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
