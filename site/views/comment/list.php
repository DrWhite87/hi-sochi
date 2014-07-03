<div class="news-comment-title">Комментарии</div>
<? if($dataProvider->totalCount > 0) :?>
<?=
yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item_view',
    'layout' => $dataProvider->totalCount > app\modules\comment\models\Comment::$pageSize ? '<ul>{items}</ul><div class="pagination-box">{pager}</div>' : '<ul>{items}</ul>',
]);
?>
<? else :?>
<div class="news-comment-box"><i>Комментарии не найдены!</i></div>
<? endif; ?>