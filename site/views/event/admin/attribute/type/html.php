<div class="form-group field-event-<?= $attr->alias?>">
    <?= \yii\helpers\Html::label($attr->name)?>
    <?= 
    \app\components\extentions\imperavi\Widget::widget([
        'name' => 'Event[moreAttributes][' . $attr->alias . ']',
        'value' => $attr->value,
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'pastePlainText' => true,
            'plugins' => [
                'clips',
                'fullscreen'
            ],
            'imageGetJson' => \yii\helpers\Url::to(['/admin/event/get']),
            'imageUpload' => \yii\helpers\Url::to(['/admin/event/image-upload']),
        ]
    ]);
    ?>
    <div class="has-error"><div class="help-block"><?= \yii\helpers\Html::error($attr, $attr->alias)?></div></div>
</div>