<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\EventAttribute $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-attribute-form">

    <?php $form = ActiveForm::begin(['validateOnSubmit' => false, 'validateOnChange' => false]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'type_id')->dropDownList($model->typeList()); ?>
    
    <?php if(!$model->isNewRecord) :?>
        <?= $form->field($model, 'category_id')->dropDownList($model->categoryList()); ?>
    <?php endif; ?>    
        
    <?= $form->field($model, 'required')->dropDownList(['0' => Yii::t('backend', 'No'), '1' => Yii::t('backend', 'Yes')]); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
