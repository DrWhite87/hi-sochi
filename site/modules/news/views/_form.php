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

    <?php $form = ActiveForm::begin(['validateOnSubmit' => false, 'validateOnChange' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'categories')->listBox($model->categoryList(), ['multiple' => 'multiple']); ?>

    <?php if (Yii::$app->user->identity->role != \app\modules\user\models\User::ROLE_USER) : ?>
        <?= $form->field($model, 'status')->dropDownList(News::statusList()) ?>   
    <?php endif; ?>
    <?= $form->field($model, 'begin_active')->textInput(['class' => 'datepicker', 'value' => !empty($model->begin_active) ? date('d/m/Y', $model->begin_active) : date('d/m/Y', time())]) ?>

    <?= $form->field($model, 'end_active')->textInput(['class' => 'datepicker', 'value' => !empty($model->end_active) ? date('d/m/Y', $model->end_active) : null]) ?>

    <br />    
    <?= $form->field($model, 'anons_image')->fileInput(); ?>

    <? if ($model->anons_image_id != 0) : ?>
    <div class="news-anons-image news-image">
        <?= Html::img($model->anonsImageUrl('small')) ?>
    </div>
    <br />
    <? endif; ?>   

    <?=
    $form->field($model, 'anons')->widget(\app\components\extentions\imperavi\Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'pastePlainText' => true,
            'plugins' => [
                'clips',
                'fullscreen'
            ],
            'imageGetJson' => \yii\helpers\Url::to(['/admin/news/get']),
            'imageUpload' => \yii\helpers\Url::to(['/admin/news/image-upload']),
        ]
    ]);
    ?>

    <br />
        <?= $form->field($model, 'content_image')->fileInput(); ?>
    <? if ($model->anons_image_id != 0) : ?>
    <div class="news-content-image news-image">
<?= Html::img($model->contentImageUrl('small')) ?>
    </div>
    <br />
    <? endif; ?>   

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
            'imageGetJson' => \yii\helpers\Url::to(['/admin/news/get']),
            'imageUpload' => \yii\helpers\Url::to(['/admin/news/image-upload']),
        ]
    ]);
    ?>

    <?= $form->field($model, 'head')->checkbox(['uncheck' => $model->head]) ?>

        <?= $form->field($model, 'tags')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'source')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
