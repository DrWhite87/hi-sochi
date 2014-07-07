<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\event\models\Event $model
 */

$this->title = Yii::t('backend', 'Create Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
