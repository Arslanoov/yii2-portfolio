<?php

/** @var $this yii\web\View */
/** @var $categories array */

use yii\helpers\Url;

?>

<ul id="options" class="clearfix extra-padding-top">
    <li class="big-line-height">
        <a href="/<?= Yii::$app->language ?>/portfolio#works" class="<?= (Url::current() == '/') ? 'selected' : '' ?>"><?= Yii::t('app', 'All') ?></a>
    </li>
    <?php foreach ($categories as $category): ?>
        <?= $this->render('_category', ['item' => $category]) ?>
    <?php endforeach; ?>
</ul>