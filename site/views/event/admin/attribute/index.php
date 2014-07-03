<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\event\models\Search $searchModel
 */
$this->title = Yii::t('backend', 'Event Attributes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Categories'), 'url' => yii\helpers\Url::toRoute('/admin/event-categories')];
$this->params['breadcrumbs'][] = $this->title . ' «' . $categoryModel->name . '»';
?>
<div class="event-attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create Attribute'), yii\helpers\Url::toRoute('/admin/event-category-attribute/' . $_GET['category'] . '/create'), ['class' => 'btn btn-success'])
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
                'attribute' => 'type_id',
                'value' => function($model) {
                    return $model->type->label;
                },
            ],
            [
                'format' => 'text',
                'attribute' => 'category_id',
                'value' => function($model) {
                    return $model->category->name;
                },
            ],
            'required',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Yii::$app->urlManager->createUrl(['admin/event-category-attribute/' . $model->category->alias . '/' . $action . '/' . $model->id]);
                },
            ],
        ],
    ]);
    ?>

</div>
