<?php

namespace app\modules\news\components\widgets;

use app\modules\news\models\News;
use yii\data\ActiveDataProvider;

class LastNewsWidget extends \yii\base\Widget {
    
    public $view = '/news/widgets/last_news_widget';
    public $pageSize = 5;
    public $sort = 'begin_active DESC';

    public function run() {
        
        $provider = new ActiveDataProvider([
            'query' => News::find()->where(['status' => 1])->orderBy($this->sort),
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
        ]);
        
        echo $this->render($this->view, ['dataProvider' => $provider]);
    }
    
}
