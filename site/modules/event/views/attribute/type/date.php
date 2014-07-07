<div class="form-group field-event-<?= $attr->alias ?>">
    <?= \yii\helpers\Html::label($attr->name)?>
    <?= \yii\helpers\Html::input('text', 'Event[eavAttributes][' . $attr->alias . ']', !empty($attr->value) ? date('d/m/Y', $attr->value) : date('d/m/Y', time()), ['class' => 'datepicker'])?>
    <div class="has-error"><div class="help-block"><?= \yii\helpers\Html::error($attr, $attr->alias)?></div></div>
</div>

<? //print_r($attr->errors); ?>