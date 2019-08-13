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
use frontend\widgets\PortfolioSkillsWidget;
use frontend\widgets\PortfolioCategoriesWidget;
use yii\helpers\Url;

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
                <div id="nav-button"> <span class="nav-bar"></span> <span class="nav-bar"></span> <span class="nav-bar"></span> </div>
            </div>
        </div>
    </div>

    <?= $this->render('_header') ?>

    <!-- start content -->
    <div id="content">

        <?= $content ?>

        <section class="white">
            <div class="container clearfix">
                <div class="col-md-7 col-md-offset-1 col-sm-6 col-xs-6">
                    <h3 class="header"><?= Yii::t('app', 'Want to work') ?> <br />
                        <?= Yii::t('app', 'together') ?>?</h3>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <p class="alignright"><a href="/<?= Yii::$app->language ?>/contact" title="" class="arrow"><?= Yii::t('app', 'Contact Me') ?></a></p>
                </div>
            </div>
        </section>
    </div>
    <!-- end content -->

    <?= $this->render('_footer') ?>
</div>
<!-- end wrap -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>