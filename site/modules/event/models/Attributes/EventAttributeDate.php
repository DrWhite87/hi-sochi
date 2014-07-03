<?php

namespace app\modules\event\models\attributes;

use Yii;

class EventAttributeDate extends EventAttributeInt {
    
    public function behaviors() {
        return [
            'BETime' => [
                'class' => BETimeBehavior::className(),
                'attributes' => ['value'],
            ],
        ];
    }

}