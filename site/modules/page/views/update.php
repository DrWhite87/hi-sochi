<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\page\models\Page $model
 */

$this->title = Yii::t('backend', 'Update Page: ', [
  'modelClass' => 'Page',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
