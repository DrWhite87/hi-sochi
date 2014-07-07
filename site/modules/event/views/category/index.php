<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\event\models\Search $searchModel
 */
$this->title = Yii::t('backend', 'Event Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create Category'), yii\helpers\Url::toRoute('/admin/event_category/create'), ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'alias',
            [
                'format' => 'text',
                'attribute' => 'event_count',
                'value' => function($model) {
                    return count($model->events);
                },
            ],
            'descr:text',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{eventList} {attributeList} {update} {delete}',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Yii::$app->urlManager->createUrl(['admin/event/category/' . $action . '/' . $model->id]);
                },
                'buttons' => [
                    'attributeList' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', Yii::$app->urlManager->createUrl(['admin/event-category-attributes/' . $model->alias]), [
                            'title' => Yii::t('backend', 'Attribute List'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'eventList' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list"></span>', Yii::$app->urlManager->createUrl(['admin/events/' . $model->alias]), [
                            'title' => Yii::t('backend', 'Event List'),
                            'data-pjax' => '0',
                        ]);
                    },
                ]
            ],
        ],
    ]);
    ?>

</div>
