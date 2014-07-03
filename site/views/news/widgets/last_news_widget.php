<?= 
    yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_last_news_item_view',
        'layout' => '<ul>{items}</ul>',
    ]);
?>