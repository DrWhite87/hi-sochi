<?php

namespace app\modules\event\models\attributes;

use Yii;

class EventAttributeDate extends EventAttributeInt {
    
    public function behaviors() {
        return [
            'BETime' => [
                'class' => \app\components\behaviors\BETimeBehavior::className(),
                'attributes' => ['value'],
            ],
        ];
    }

}