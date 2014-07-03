<div class="form-group field-event-<?= $attr->alias ?>">
    <?= \yii\helpers\Html::label($attr->name)?>
    <?= \yii\helpers\Html::textarea('Event[moreAttributes][' . $attr->alias . ']',  $model->moreAttributes->{$attr->alias}, ['class' => 'form-control'])?>
    <div class="has-error"><div class="help-block"><?= \yii\helpers\Html::error($attr, $attr->alias)?></div></div>
</div>