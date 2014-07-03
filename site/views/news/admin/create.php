<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\news\models\News $model
 */

$this->title = Yii::t('backend', 'Create News', [
  'modelClass' => 'News',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
