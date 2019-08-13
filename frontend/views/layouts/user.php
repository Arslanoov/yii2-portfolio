<?php

/** @var $this yii\web\View */

use frontend\assets\AppAsset;
use frontend\assets\VKAsset;
use yii\helpers\Html;
use frontend\assets\FooterAsset;
use yii\widgets\Menu;
use portfolio\helpers\PageHelper;
use portfolio\readModels\PageReadRepository;
use yii\caching\Cache;
use frontend\widgets\RecentWorksWidget;

AppAsset::register($this);

$pageHelper = new PageHelper(new PageReadRepository());

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
</head>

<body class="no-intro white-header amiri">
<?php $this->beginBody() ?>

<?= $this->render('_nav', [
    'pageHelper' => $pageHelper
]) ?>

<div id="content-overlay"></div>

<div id="wrap">

    <div id="menu-button">
        <div class="centralizer">
            <div class="cursor">
                <div id="nav-button">
                    <span class="nav-bar"></span>
                    <span class="nav-bar"></span>
                    <span class="nav-bar"></span>
                </div>
            </div>
        </div>
    </div>

    <?= $this->render('_header') ?>

    <!-- start content -->
    <div id="content">
        <section class="white">
            <?= $content ?>
        </section>
    </div>
    <!-- end content -->

    <footer id="footer">
        <div class="container clearfix white">
            <p class="alignleft">© <?= date('Y') ?>, Расуль Арсланов</p>
        </div>
    </footer>
</div>
<!-- end wrap -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>