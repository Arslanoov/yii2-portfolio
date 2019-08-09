<?php

/** @var $this yii\web\View */
/** @var $works array */

?>

<div class="container clearfix">
    <div class="col-lg-12 white-text centered extra-padding-bottom">
        <h2 class="header"><?= Yii::t('app','My latest works') ?></h2>
    </div>
</div>
<div class="container clearfix">
    <div id="container">
        <?php foreach ($works as $work): ?>
            <?= $this->render('_work', ['item' => $work]) ?>
        <?php endforeach; ?>
    </div>
</div>
<div class="container clearfix">
    <div class="col-lg-12 white-text centered">
        <p><a href="/<?= Yii::$app->language ?>/portfolio" title="" class="arrow"><?= Yii::t('app', 'See all') ?></a></p>
    </div>
</div>