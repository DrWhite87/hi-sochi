<?php
use yii\helpers\Html;
?>
<div class="news-view-news-content">
    <? if(!empty($model->image_id) && $model->image_id != 0): ?>
    <?= Html::img($model->contentImageUrl('small'), ['class' => 'news-view-content-img']); ?>
    <? endif; ?>   
    <?= $model->content ?>
    <br />
    <p><b>Дата публикации:</b> <?= date('d.m.Y', $model->begin_active) ?>г.</p>
    <? if(!empty($model->tags)): ?>
    <p><b>Теги: </b><?= app\components\widgets\TagsLinksWidget::widget(['tagsString' => $model->tags, 'route' => '/news']) ?></p>
    <? endif; ?>
    <? if(!empty($model->categories)): ?>
    <p><b>Категории: </b><?= app\components\widgets\CategoriesLinksWidget::widget(['categories' => $model->categories, 'route' => '/news']) ?></p>
    <? endif; ?>
    <? if(!empty($model->source)): ?>        
    <br />
    <i>Источник: <?= Html::a($model->source, $model->source) ?></i>
    <? endif; ?>
</div> 