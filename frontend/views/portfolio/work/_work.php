<?php

/* @var $this yii\web\View */
/* @var $model blog\entities\Portfolio\Work\Work */

use yii\helpers\Html;
use yii\helpers\Url;

$url = '/' . Yii::$app->language . '/portfolio/' . $model->id . '-' . $model->slug;

?>

<div class="element clearfix col-md-6 col-sm-6 home two">
    <a href="/<?= Yii::$app->language ?>/portfolio/<?= $model->id ?>-<?= $model->slug ?>" class="transition-link" target="_blank">
        <?php if ($model->photo): ?>
            <img src="<?= Html::encode($model->getThumbFileUrl('photo', 'widget')) ?>" class="img-responsive" alt=""/>
        <?php endif; ?>
        <div class="title-holder">
            <h3><?= Html::encode($model->title) ?></h3>
            <p class="large"><?= Html::encode($model->category->name) ?></p>
        </div>
        <div class="overlay"></div>
    </a>
</div>