<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\news\models\News;

/**
 * @var yii\web\View $this
 * @var app\modules\news\models\News $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['validateOnSubmit' => false, 'validateOnChange' => false, 'action' => 'admin/news/upimage', 'options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= Html::fileInput('file')//$form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
