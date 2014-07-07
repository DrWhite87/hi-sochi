<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\EventAttribute $model
 */

$this->title = Yii::t('backend', 'Create Attribute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Categories'), 'url' => yii\helpers\Url::toRoute('/admin/event-categories')];
$this->params['breadcrumbs'][] = ['label' => '«' . $model->category->name . '»', 'url' => yii\helpers\Url::toRoute('/admin/event/' . $model->category->alias)];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Event Attributes'), 'url' => yii\helpers\Url::toRoute('/admin/event-category-attributes/' . $model->category->alias)];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-attribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
