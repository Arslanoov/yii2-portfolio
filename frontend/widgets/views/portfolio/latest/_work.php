<?php

/** @var $this yii\web\View */
/** @var $item \blog\entities\Portfolio\Work\Work */

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="element clearfix col-sm-6 home travel">
    <a href="/<?= Yii::$app->language ?>/portfolio/<?= $item->id ?>-<?= $item->slug ?>" data-title="Image Title" class="transition-link">
        <?php if ($item->photo): ?>
            <img src="<?= $item->getThumbFileUrl('photo', 'widget') ?>" alt="" />
        <?php endif; ?>
        <div class="title-holder">
            <h3><?= Html::encode($item->title) ?></h3>
            <p class="large"><?= Html::encode($item->category->name) ?></p>
        </div>
        <div class="overlay"></div>
    </a>
</div>