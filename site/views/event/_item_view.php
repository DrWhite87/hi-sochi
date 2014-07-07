<?php

use yii\helpers\Html;

?>    
<li>
    <div class="event-index-news-title">
        <?= Html::a(Html::encode($model->title), 'afisha/' . $model->alias . '.html') ?>
    </div>
    <div class="event-index-event-box">
        <div class="event-view-index-img-box"><?= Html::a(Html::img($model->imageUrl('small'), ['class' => 'event-index-anons-img']), 'event/' . $model->alias . '.html') ?></div>
        <div class="event-index-event-descr">
            <div class="event-index-event-descr-box"><?= $model->descr ?></div>
            <div class="event-index-event-all"><?= Html::a('Читать далее>>', 'event/' . $model->alias . '.html') ?></div>
        </div>
    </div>						
</li>
<li class="line"></li>
