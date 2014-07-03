<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components\extentions\imperavi;
use Yii;
use yii\web\AssetBundle;

/**
 * @author Alexander Yaremchuk <alwex10@gmail.com>
 * @since 1.0
 */
class ImperaviRedactorAsset extends AssetBundle
{
    public $sourcePath = '@app/components/extentions/imperavi/assets';
    public $js = [
        'redactor.js'
    ];
    public $css = [
        'redactor.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init() {
        /*
         * Language fix
         * @author <https://github.com/sim2github>
         */
        $appLanguage = strtolower(substr(Yii::$app->language , 0, 2)); //First 2 letters

        if($appLanguage != 'en')
            $this->js[] = 'lang/' . $appLanguage . '.js';

        parent::init();
    }
}
