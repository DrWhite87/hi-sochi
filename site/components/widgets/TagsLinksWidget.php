<?php

namespace app\components\widgets;

class TagsLinksWidget extends \yii\base\Widget {
    
    public $tagsString;
    public $route;

    public function run() {
        $tags = \app\modules\tags\models\Tags::string2array($this->tagsString);
        echo $this->render('/widgets/tags_links_widget', ['tags' => $tags, 'route' => $this->route]);
    }
    
}
