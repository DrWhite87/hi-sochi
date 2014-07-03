<?php

namespace app\components\widgets;

class CategoriesLinksWidget extends \yii\base\Widget {
    
    public $categories;
    public $route;

    public function run() {
        echo $this->render('/widgets/categories_links_widget', ['categories' => $this->categories, 'route' => $this->route]);
    }
    
}
