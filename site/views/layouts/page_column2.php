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
    <?= $content ?>
</div>	
<?php $this->endContent(); ?>