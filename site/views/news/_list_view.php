<div class="news-index">
    <h1 class="news-index-title"><?= \yii\helpers\Html::encode(Yii::t('frontend', 'News')); ?></h1>
   
    <ul>
        {items}
    </ul>
    <div class="pagination-box">{pager}</div>    
</div>
