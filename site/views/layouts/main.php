<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\IndexAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
IndexAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title . ' | ' . Yii::$app->name) ?></title>
        <?php $this->head() ?>
        <script src="http://vk.com/js/api/openapi.js" type="text/javascript"></script>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="container">
            <!-- Шапка -->
            <div class="header">
                <div class="lang">рус | <a href="#">eng</a></div> 
            </div>
            <div class="menu">
                <?php
                echo Menu::widget([
                    'items' => [
                        ['label' => 'Главная', 'url' => ['/']],
                        ['label' => 'Новости', 'url' => ['/news']],
                        ['label' => 'Афиша', 'url' => ['/afisha']],
                        ['label' => 'Отдых', 'url' => ['/recreation']],
                        ['label' => 'Недвижимость', 'url' => ['/realty']],
                        ['label' => 'Транспорт', 'url' => ['/transport']],
                        ['label' => 'Организации', 'url' => ['/organizations']],
                        ['label' => 'Карта города', 'url' => ['/city-map']],
                        ['label' => 'Веб-камеры', 'url' => ['/webcams']],
                        ['label' => 'Наш Сочи', 'url' => ['/our-Sochi']],
                    ],
                ]);
                ?>
                <!--ul>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">Афиша</a></li>
                    <li><a href="#">Отдых</a></li>
                    <li><a href="#">Недвижимость</a></li>
                    <li><a href="#">Транспорт</a></li>
                    <li><a href="#">Работа</a></li>
                    <li><a href="#">Организации</a></li>
                    <li><a href="#">Карта города</a></li>
                    <li><a href="#">Погода</a></li>
                    <li><a href="#">Веб-камеры</a></li>
                    <li><a href="#">Наш Сочи</a></li>
                </ul-->

            </div>
            <div class="search-box">
                <div class="search">Поиск по сайту: <input type="text" name="serach" placeholder="Введите слово или словосочетание..."/> <?= Html::img(Yii::getAlias('@web') . '/images/search.png', ['alt' => 'search']) ?></div>
            </div>

            <!-- Правый слайдбар -->
            <div class="sidebar1">
                <!--div class="afisha">
                    <div class="afisha-title">
                        Афиша
                    </div>
                </div-->
                <div class="prognoz">
                    <div class="prognoz-title">
                        Прогноз погоды
                    </div>
                    <table cellpadding=0 cellspacing=0 width=260 style="margin-left: 5px;margin-top: 10px; margin-bottom: 10px;font-family:Arial;font-size:14px;background-color:#ffffff"><tr><td><table width=100% cellpadding=0 cellspacing=0><tr><td width=8 height=30 background="http://rp5.ru/informer/htmlinfa/topshl.png"  bgcolor=#E48D0A> </td><td width=* align=center background="http://rp5.ru/informer/htmlinfa/topsh.png" bgcolor=#E48D0A><a style="color:#ffffff; font-family:Arial;font-size: 12px;" href="http://rp5.ru/7694/ru"><b>Сочи</b></a></td><td width=8 height=30 background="http://rp5.ru/informer/htmlinfa/topshr.png" bgcolor=#E48D0A> </td></tr></table></td></tr><tr><td valign=middle style="padding:0;"><iframe src="http://rp5.ru/htmla.php?id=7694&lang=ru&um=00000&bg=%23ffffff&ft=%23ffffff&fc=%23E48D0A&c=%23000000&f=Arial&s=14&sc=4" width=100% height=259 frameborder=0 scrolling=no style="margin:0;"></iframe></td></tr></table>
                </div>
                <div class="kurs">
                    <div class="kurs-title">
                        Курсы валют
                    </div>
                    <!-- Информер курса валют -->
                    <div style="padding-bottom:3px;"></div>
                    <div id="informer_1" style="margin-top: 10px; margin-bottom: 10px;"></div>
                    <script src="http://monavista.ru/informer_valuta.js" type="text/javascript" charset="utf-8"></script>
                    <!-- Информер курса валют -->

                </div>
                <!--div class="new">
                    <div class="new-title">
                        Новое на сайте
                    </div>
                </div-->
                <div class="social">
                    <div class="social-title">
                        Присоединяйтесь к нам:                        
                    </div>
                    <script type="text/javascript" src="//vk.com/js/api/openapi.js?113"></script>

                    <!-- VK Widget -->
                    <div id="vk_groups" style="margin-left: 5px;margin-top: 10px; margin-bottom: 10px;"></div>
                    <script type="text/javascript">
                        VK.Widgets.Group("vk_groups", {mode: 0, width: "260", height: "442", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 33159981);
                    </script>
                </div>
                <!--div class="podpiska">
                    <div class="podpiska-title">
                        Подписка на новости
                    </div>
                </div-->
            </div>
            <!-- Коннтент -->
            <div class="content">
                <?= $content ?>
            </div>    
            <!-- Подвал -->
            <div class="footer">
                <div class="menufooter">
                    <ul>
                        <li><a href="#">ГЛАВНАЯ</a></li>
                        <li><a href="#">КОНТАКТЫ</a></li>
                        <li><a href="#">РЕКЛАМА НА САЙТЕ</a></li>
                        <li><a href="#">FAQ ПО САЙТУ</a></li>

                    </ul>  </div>
                <br>
                <div class="copyright">
                    <p>
                        <!--LiveInternet logo--><a href="//www.liveinternet.ru/click"
                                                   target="_blank"><img src="//counter.yadro.ru/logo?50.6"
                                             title="LiveInternet"
                                             alt="" border="0" width="31" height="29"/></a><!--/LiveInternet--></div>

                Copyright  © <a href="http://hi-sochi.ru">Hi-Sochi.ru</a> – Портал о городе Сочи. Перепечатка материалов <br>
                допускается только с письменного разрешения редакции!</p>


            </div>

        </div>

    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
