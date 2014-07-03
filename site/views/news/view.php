<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\news\models\News $model
 */
$this->title = Yii::t('frontend', $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">
    <h1 class="news-view-title"><?= $model->title ?></h1>

    <?= $this->render('_view', ['model' => $model]) ?>

    <?=
    $this->render('/comment/index', [
        'model' => $model,
    ]);
    ?> 

</div>