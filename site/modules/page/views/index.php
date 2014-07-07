<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\page\models\Search $searchModel
 */
$this->title = Yii::t('backend', 'Pages');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create Page'), ['create'], ['class' => 'btn btn-success'])
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
            //'content:ntext',
            [
                'format' => 'text',
                'attribute' => 'created',
                'value' => function($model) {
                    return date('d/m/Y', $model->created);
                },
            ],
            [
                'format' => 'text',
                'attribute' => 'updated',
                'value' => function($model) {
                    return date('d/m/Y', $model->updated);
                },
            ],
            'weight',
            'status',
            [   
                'class' => 'app\components\grid\ActionColumn',
                'buttons' => [
                    'view'=>function ($url, $model) {
                                $customurl=Yii::$app->getUrlManager()->createUrl([$model->alias . '.html']); //$model->id для AR
                                return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl, ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                        }
                ],
            ],
        ],
    ]);
    ?>

</div>
