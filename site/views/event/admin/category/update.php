<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\EventAttribute $model
 */
$this->title = Yii::t('backend', 'Update Category: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Category'), 'url' => yii\helpers\Url::toRoute('/admin/event/categories')];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="event-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
