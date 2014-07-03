<?php

namespace app\modules\event\controllers;

use yii\web\Controller;
use app\modules\event\models\Event;

class EventController extends Controller {

    public function actionIndex() {
        $model = Event::findOne(1);
        print_r($model->moreAttributes);
        $post['Event']['descr'] = 'Abkmv2';
        $post['Event']['moreAttributes']['actors'] = 'Васян ПРО';
        $post['Event']['moreAttributes']['date_primera'] = 5555123874;
        //print_r($post);
        $model->moreAttributes = $post['Event']['moreAttributes'];
        $model->descr = $post['Event']['descr'];
        $model->save();


        //print_r($model->moreAttributes);   
    }

}
