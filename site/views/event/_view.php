<?php

use yii\helpers\Html;
?>
<div class="event-view-event-content">
    <? if(!empty($model->image_id) && $model->image_id != 0): ?>
    <?= Html::img($model->imageUrl('small'), ['class' => 'event-view-content-img']); ?>
    <? endif; ?>   
    <?= $model->descr ?>
    <br />
    <p><b>Начало события:</b> <?= date('d.m.Y', $model->date_begin) ?>г.</p>

    <?php foreach ($model->eavAttributes as $attr) : ?>
        <?php if (!empty($attr->value)) : ?>
            <?=
            $attr->eavModel->render('attribute_type/' . $attr->type->name, [
                'attr' => $attr
            ]);
            ?>            
        <?php endif; ?>
    <?php endforeach; ?>

    <? if(!empty($model->tags)): ?>
    <p><b>Теги: </b><?= app\components\widgets\TagsLinksWidget::widget(['tagsString' => $model->tags, 'route' => '/events']) ?></p>
    <? endif; ?>
</div> 