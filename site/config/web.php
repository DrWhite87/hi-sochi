<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

// получаем список директорий в protected/modules
$dirs = scandir(dirname(__FILE__) . '/../modules');

// строим массив
$modules = array();
foreach ($dirs as $name) {
    if ($name[0] != '.')
        $modules[$name] = array(
            'class' => 'app\modules\\' . $name . '\\' . ucfirst($name) . 'Module',
            'viewPath' => dirname(__DIR__) . '\views'
        );
}

// строка вида 'news|page|user|...|socials'
// пригодится для подстановки в регулярные выражения общих правил маршрутизации
define('MODULES_MATCHES', implode('|', array_keys($modules)));

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'language' => 'ru-RU',
    'language' => 'ru',
    'name' => 'Портал города Сочи',
    //'defaultController' => 'page',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                // captha 
               
                '<module:\w+>/captcha' => '<module>/news/captcha',
                //autorization
                '/<action:(login|logout)>' => 'auth/auth/<action>',
                '' => 'site/index',
                
                
                '/comment/<module:\w+>/<id:\d+>' => 'comment/comment/index',
                '/comment/add/<module:\w+>/<id:\d+>' => 'comment/comment/add',
                /* новости */
                '/news' => 'news/news/index',               
                '/news/<alias:[-\w]+>.html' => 'news/news/view',  
                
                /* события */    
                '/afisha' => 'event/event/index',                
                '/afisha/<alias:[-\w]+>.html' => 'event/event/view',  
                
                           
                 /* события админка*/    
                '/admin/events/<category:\w+>' => 'event/admin/index',
                '/admin/event/<category:\w+>/<action:\w+>' => 'event/admin/<action>',
                '/admin/event/<category:\w+>/<action:\w+>/<id:\d+>' => 'event/admin/<action>',
                
                /* атрибуты категорий */
                '/admin/event-category-attributes/<category:\w+>' => 'event/attribute/index',
                '/admin/event-category-attribute/<category:\w+>/<action:\w+>' => 'event/attribute/<action>',
                '/admin/event-category-attribute/<category:\w+>/<action:\w+>/<id:\d+>' => 'event/attribute/<action>',
                /* категории событий */
                '/admin/event-categories' => 'event/category/index',
                '/admin/event-category/<action:\w+>' => 'event/category/<action>',
                
                /* админка */
                
                'admin' => 'admin/admin/index',
                'admin/<module:\w+>' => '<module>/admin/index',
                '/admin/<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/admin/<action>',
                '/admin/<module:\w+>/<action:[-\w]+>' => '<module>/admin/<action>',
                
                 /* общее правило */
                '<module:\w+>/<controller:\w+>/<action:[-\w]+>' => '<module>/<controller>/<action>',                
                '<module:\w+>/<controller:\w+>/<action:[-\w]+>/<alias:\w+>' => '<module>/<controller>/<action>',
                /* Статические страницы */
                '/page' => 'page/page/index',
                '<alias:[/-\w]+>.html' => 'page/page/view',
                '<alias:[/-\w]+>' => 'page/page/view',
               
                
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => 'login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        // подключение компонента для генерации ajax-ответов
        'ajax' => array(
            'class' => 'app\components\AsyncResponse',
        ),
        'i18n' => array(
            'translations' => array(
                'model' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => array(
                        'model' => 'model.php',
                    ),
                ),
                'frontend' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => array(
                        'frontend' => 'frontend.php',
                    ),
                ),
                'backend' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => array(
                        'backend' => 'backend.php',
                    ),
                ),
            ),
        ),
        'image' => array(
            'class' => 'app\components\image\Image',
        ),
    ],
    'modules' => array_replace($modules, [
    ]),
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
