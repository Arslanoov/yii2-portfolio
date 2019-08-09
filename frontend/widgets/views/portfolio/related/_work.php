<?php

/** @var $this \yii\web\View */
/** @var $item \blog\entities\Portfolio\Work\Work */

use yii\helpers\Url;
use yii\helpers\Html;

?>


<div class="element clearfix col-md-6 col-sm-6 home">
    <a href="/<?= Yii::$app->language ?>/portfolio/<?= $item->id ?>-<?= $item->slug ?>" class="transition-link">
        <img src="<?= $item->getThumbFileUrl('photo', 'widget') ?>" alt="" />
        <div class="title-holder">
            <h3><?= Html::encode($item->title) ?></h3>
            <p class="large"><?= Html::encode($item->category->name) ?></p>
        </div>
        <div class="overlay"></div>
    </a>
</div>