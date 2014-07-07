<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\event\models\Event;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\Event $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(['validateOnSubmit' => false, 'validateOnChange' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'date_begin')->textInput(['class' => 'datepicker', 'value' => !empty($model->date_begin) ? date('d/m/Y', $model->date_begin) : date('d/m/Y', time())]) ?>

    <?= $form->field($model, 'date_end')->textInput(['class' => 'datepicker', 'value' => !empty($model->date_end) ? date('d/m/Y', $model->date_end) : null]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->categoryList()); ?>

    <?= $form->field($model, 'status')->dropDownList(Event::statusList()) ?>   

    <br />
    <?= $form->field($model, 'image')->fileInput(); ?>
    <?php if ($model->image_id != 0) : ?>
    <div class="event-content-image event-image">
        <?= Html::img($model->imageUrl('small')) ?>
    </div>
    <br />
    <?php endif; ?> 
    
    <?=
    $form->field($model, 'descr')->widget(\app\components\extentions\imperavi\Widget::className(), [
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

    <?= $form->field($model, 'tags')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
