<?php for($i = 0; $i < $j = count($categories); $i++) :?>   
<?= \yii\helpers\Html::a($categories[$i]['name'], \yii\helpers\Url::toRoute($route) . '?category=' . $categories[$i]['alias']) . ($i < $j-1 ? ', ' : '');?>
<?php endfor; ?>