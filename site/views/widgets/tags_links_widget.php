<?php for($i = 0; $i < $j = count($tags); $i++) :?>   
<?= \yii\helpers\Html::a($tags[$i], \yii\helpers\Url::toRoute($route) . '?tags=' . $tags[$i]) . ($i < $j-1 ? ', ' : '');?>
<?php endfor; ?>