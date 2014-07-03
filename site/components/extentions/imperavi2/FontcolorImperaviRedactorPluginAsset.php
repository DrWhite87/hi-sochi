<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components\extentions\imperavi;
use yii\web\AssetBundle;

/**
 * @author Alexander Yaremchuk <alwex10@gmail.com>
 * @since 1.0
 */
class FontcolorImperaviRedactorPluginAsset extends AssetBundle
{
    public $sourcePath = '@app/components/extentions/imperavi/assets/plugins/fontcolor';
    public $js = [
        'fontcolor.js',
    ];
    public $css = [

    ];
    public $depends = [
        'app\components\extentions\imperavi\ImperaviRedactorAsset'
    ];
}