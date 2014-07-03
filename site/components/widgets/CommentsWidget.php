<?php

namespace app\components\widgets;

use yii\data\ActiveDataProvider;

class CommentsWidget extends \yii\base\Widget {

    public $view = '/widgets/comments_widget';
    public $query;
    public $pageSize = 10;

    public function run() {

                
        $provider = new ActiveDataProvider([
            'query' => $this->query,
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
        ]);

        echo $this->render($this->view, ['dataProvider' => $provider]);
        \Yii::$app->end();
    }
}    