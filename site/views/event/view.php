<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\News $model
 */
$this->title = Yii::t('frontend', $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Event'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">
    <h1 class="event-view-title"><?= $model->title ?></h1>

    <?= $this->render('_view', ['model' => $model]) ?>

    <?=
    $this->render('/comment/index', [
        'model' => $model,
    ]);
    ?> 

</div>