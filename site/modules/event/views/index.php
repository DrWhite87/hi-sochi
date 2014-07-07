<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\event\models\Search $searchModel
 */

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Categories'), 'url' => yii\helpers\Url::toRoute('/admin/event-categories')];
$this->title = Yii::t('backend', 'Events');
$this->params['breadcrumbs'][] = '«' . $categoryModel->name . '»';
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Event'), yii\helpers\Url::toRoute('/admin/event/' . $categoryModel->alias . '/create'), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'alias',
            'title',
            'descr:ntext',
            [
                'format' => 'text',
                'attribute' => 'date_begin',
                'value' => function($model) {
                    return date('d/m/Y', $model->date_begin);
                },
            ],
            [
                'format' => 'text',
                'attribute' => 'price',
                'value' => function ($model) {
                    print_r($model->eavAttributes);
                    //return $model->eavAttributes;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Yii::$app->urlManager->createUrl(['admin/event/' . $model->category->alias . '/' . $action. '/' . $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
