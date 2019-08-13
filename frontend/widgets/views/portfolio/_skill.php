<?php

/** @var $item \blog\entities\Portfolio\Skill */

use yii\helpers\Url;
use yii\helpers\Html;
use portfolio\helpers\StringHelper;

?>

<li class="big-line-height">
    <a href="/<?= Yii::$app->language ?>/portfolio/skill/<?= $item->slug ?>#works" class="<?= (Url::current() == '/portfolio/skill/' . $item->slug) ? 'selected' : '' ?>">
        <?= StringHelper::cut(Html::encode($item->name), 20) ?>
    </a>
<li>