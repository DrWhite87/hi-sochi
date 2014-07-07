<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\news\models\NewsComment $model
 * @var ActiveForm $form
 */

?>

<?php

$this->registerJs("
    $(function () {
        $('.news-comments').load('" . Yii::getAlias('@web') . "/comment/" . Yii::$app->controller->module->id . "/" . $model->id . "');
        $('body').on('click', '.pagination li a', function(e){            
            $.ajax({
                type: 'GET',
                url: $(this).attr('href'),
                success: function (data) {
                    $('.news-comments').html(data);                    
                },
            });
            e.preventDefault();
        });
    });", \yii\web\View::POS_END, 'pagination');
?>

<div class="news-comments">
        
</div>

<div class="news-comment-form">
    <div class="news-comment-form-title">Добавить комментарий</div>
    <div class="errors-validate"></div>
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
        <? if(Yii::$app->user->isGuest) :?>
        <?= $form->field($model->comment, 'user_name') ?>
        <?= $form->field($model->comment, 'user_email') ?>
        <? else :?>
        <div class="margin_10_0"><b>Имя: </b> <?= Yii::$app->user->identity->first_name ?></div>
        <? endif; ?>
        <?= $form->field($model->comment, 'content')->textarea() ?>        
        <?php if(Yii::$app->user->isGuest) :?>
            <?= $form->field($model->comment, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
                'captchaAction' => '/' . Yii::$app->controller->module->id . '/captcha',
                'options' => ['class' => 'form-control'],
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
            ]) ?>
        <?php endif; ?>
        <br />
        <div class="form-group news-comment-submit">
            <?= Html::submitButton(Yii::t('model', 'Submit'), ['class' => 'btn btn-primary news-comment-submit-btn']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- comment_form -->

<?php $this->registerJs("
    $(function () {
        $('.news-comment-submit-btn').click(function(){
            $.ajax({
                type: 'POST',
                url: '" . Yii::getAlias('@web') . "/comment/add/" . Yii::$app->controller->module->id . "/" . $model->id . "',
                dataType: 'JSON',    
                data: $('.news-comment-form form').serialize(),
                success: function (data) {
                    if(data != 'OK'){     
                        var html = '';
                        for(var key in data){
                             html += data[key] + '<br />';
                        }                        
                        $('.errors-validate').show().html(html);
                    }else{                    
                        $('.news-comments').load('" . Yii::getAlias('@web') . "/comment/" . Yii::$app->controller->module->id . "/" . $model->id . "');
                        $('.news-comment-form form').trigger( 'reset' );    
                    }
                },
            });
            return false;
        });
    });",
   \yii\web\View::POS_END, 'news-comment-form');
?>