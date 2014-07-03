<?php

use yii\helpers\Html;

?>    
<li>
    <div class="news-index-news-title">
        <?= Html::a(Html::encode($model->title), 'news/' . $model->alias . '.html') ?>
    </div>
    <div class="news-index-news-box">
        <div class="news-view-index-img-box"><?= Html::a(Html::img($model->anonsImageUrl('small'), ['class' => 'news-index-anons-img']), 'news/' . $model->alias . '.html') ?></div>
        <div class="news-index-news-anons">
            <p><?= $model->anons ?></p>
            <div class="news-index-news-all"><?= Html::a('Читать далее>>', 'news/' . $model->alias . '.html') ?></div>
        </div>
    </div>						
</li>
<li class="line"></li>
