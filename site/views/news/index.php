<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\news\models\Search $searchModel
 */
$this->title = Yii::t('frontend', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= 
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item_view',
        'layout' => $this->render('_list_view',array(),true),
        'pager' => ['options' => ['class' => 'pagination']]
    ]);
?>
