<?php /* @var $this Controller */ ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<!-- Правый слайдбар -->
<div class="sidebar1">
    <div class="afisha">
        <div class="afisha-title">
            Афиша
        </div>
    </div>
    <div class="prognoz">
        <div class="prognoz-title">
            Прогноз погоды
        </div>
    </div>
    <div class="kurs">
        <div class="kurs-title">
            Курсы валют
        </div>
    </div>
    <div class="new">
        <div class="new-title">
            Новое на сайте
        </div>
    </div>
    <div class="social">
        <div class="social-title">
            Присоединяйтесь к нам:
        </div>
    </div>
    <div class="podpiska">
        <div class="podpiska-title">
            Подписка на новости
        </div>
    </div>
</div>
<!-- Коннтент -->
<div class="content">
    <div id="slider">
        <div class="slider-title">Лучшее на сайте</div>
        <div class="slider-main">
            <img src="images/slider/img_slider_1.jpg" />
            <div class="slider-main-box">
                <a href="#">Как заработать на дому маме в декрете? Полезные советы</a>
                <p class="slider-main-anons">Не каждая женщина, находящаяся в декретном отпуске, способна благополучно существовать...</p>
            </div>						
        </div>
        <div class="slider-other">
            <ul>
                <li>
                    <a href="#"><img src="images/slider/img_slider_2_s.jpg" /></a>
                    <div class="slider-other-title">
                        <a href="#">Какие прически нравятся мужчинам?</a>
                    </div>
                </li>
                <li>
                    <a href="#"><img src="images/slider/img_slider_3_s.jpg" /></a>
                    <div class="slider-other-title">
                        <a href="#">Свадебные укладки для коротких волос</a>
                    </div>
                </li>
                <li>
                    <a href="#"><img src="images/slider/img_slider_4_s.jpg" /></a>
                    <div class="slider-other-title">
                        <a href="#">Медовые маски для жирных волос</a>
                    </div>
                </li>
                <li>
                    <a href="#"><img src="images/slider/img_slider_5_s.jpg" /></a>
                    <div class="slider-other-title">
                        <a href="#">Фруктовые маски для ослабленных волос</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="now">
        <div class="now-title">Актуальное</div>		
        <?= \app\modules\news\components\widgets\LastNewsWidget::widget() ?>        
    </div>
</div>	
<?php $this->endContent(); ?>