<div class="news-comment-box">
    <div class="news-comment-username"> 
        <b>Имя: </b><?= ($model->user_id != 0) ? $model->author->first_name : $model->user_name ?>&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Дата: </b><?= date('H:i d.m.Y', $model->created) ?>
    </div>
    <div class="news-comment-content"> 
        <?= $model->content ?>
    </div>
</div>