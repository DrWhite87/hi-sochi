<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\news\models\Search $searchModel
 */
$this->title = Yii::t('backend', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create News', [
                    'modelClass' => 'News',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'title',
            'alias',
            'anons:ntext',
            [
                'format' => 'text',
                'attribute' => 'begin_active',
                'value' => function($model) {
                    return date('d/m/Y', $model->begin_active);
                },
            ],
            [
                'format' => 'text',
                'attribute' => 'end_active',
                'value' => function($model) {
                    return !empty($model->end_active) ? date('d/m/Y', $model->end_active) : null;
                },
            ],
            [
                'format' => 'text',
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->lookup->name;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
