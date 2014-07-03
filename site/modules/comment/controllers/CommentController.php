<?php

namespace app\modules\comment\controllers;

use yii\web\Controller;

class CommentController extends \app\components\MyController {
    
    public function actionIndex($module, $id) {
        if(\Yii::$app->request->isAjax){
            $provider = new \yii\data\ActiveDataProvider([
                'query' => \app\modules\comment\models\Comment::find()->where(['status' => 1, 'element_id' => $id, 'module' => $module])->orderBy('created DESC'),
                'pagination' => [
                    'pageSize' => \app\modules\comment\models\Comment::$pageSize,
                ],
            ]);

            echo $this->renderAjax('list', ['dataProvider' => $provider]);
        }
    }

    public function actionAdd($module, $id) {
        if(\Yii::$app->request->isAjax){
            $model = new \app\modules\comment\models\Comment();
            $model->scenario = 'captchaRequired';

            if ($model->load(\Yii::$app->request->post())) {
                $model->module = $module;
                $model->element_id = $id;
                if ($model->save()) {
                    echo json_encode('OK');
                    \Yii::$app->end();
                } else {
                    echo json_encode($model->errors);
                }
            }
        }
    }

}
