<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\news\models\News $model
 */

$this->title = Yii::t('backend', 'Update News: ', [
  'modelClass' => 'News',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
