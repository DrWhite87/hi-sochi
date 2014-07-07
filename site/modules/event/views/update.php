<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\Event $model
 */

$this->title = Yii::t('backend', 'Update Event: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Categories'), 'url' => yii\helpers\Url::toRoute('/admin/event-categories')];
$this->params['breadcrumbs'][] = ['label' => '«' . $model->category->name . '»', 'url' => yii\helpers\Url::toRoute('/admin/events/' . $model->category->alias)];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
