<?php

use yii\helpers\Html;

?>    
<li>
    <div class="now-news-title">
        <?= Html::a(Html::encode($model->title), 'news/' . $model->alias . '.html') ?>
    </div>
    <div class="now-news-box">
        <div class="now-news-img-box"><?= Html::a(Html::img($model->anonsImageUrl('small'), ['class' => 'news-index-anons-img']), 'news/' . $model->alias . '.html') ?></div>
        <div class="now-news-anons">
            <p><?= $model->anons ?></p>
            <div class="now-news-all"><?= Html::a('Читать далее>>', 'news/' . $model->alias . '.html') ?></div>
        </div>
    </div>						
</li>
<li class="line"></li>
