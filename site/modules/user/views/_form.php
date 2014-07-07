<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'authKey')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
