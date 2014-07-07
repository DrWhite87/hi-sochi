<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\extentions\tinymce\Tinymce;

/**
 * @var yii\web\View $this
 * @var app\modules\page\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?=
    $form->field($model, 'content')->widget(\app\components\extentions\imperavi\Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'pastePlainText' => true,
            'plugins' => [
                'clips',
                'fullscreen'
            ],
            'imageGetJson' => \yii\helpers\Url::to(['/admin/page/get']),
            'imageUpload' => \yii\helpers\Url::to(['/admin/page/image-upload']),
        ]
    ]);
    ?>

    <?= $form->field($model, 'weight')->textInput(['value' => '500']) ?>

    <?= $form->field($model, 'status')->checkbox(['uncheck' => $model->status]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
