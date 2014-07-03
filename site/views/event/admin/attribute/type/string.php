<div class="form-group field-event-<?= $attr->alias ?>">
    <?= \yii\helpers\Html::label($attr->name)?>
    <?= \yii\helpers\Html::input('text', 'Event[moreAttributes][' . $attr->alias . ']', $attr->value, ['class' => 'form-control'])?>
     <div class="has-error"><div class="help-block"><?= \yii\helpers\Html::error($attr, $attr->alias)?></div></div>
</div>