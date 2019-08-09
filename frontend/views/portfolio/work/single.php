<?php

/** @var $this yii\web\View */
/** @var $work blog\entities\Portfolio\Work\Work */
/** @var $data \blog\entities\Portfolio\Work\WorkData */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\RelatedWorksWidget;

$this->title = Yii::t('app', 'Portfolio') . ' | ' . $work->getSeoTitle();
$this->registerMetaTag(['name' => 'description', 'content' => $work->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $work->meta->keywords]);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Portfolio'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = Html::encode($work->title);

?>

<section class="white">
    <div class="container clearfix">
        <div class="col-md-7 col-md-offset-1">
            <h1 class="header"><?= Html::encode($work->title) ?></h1>
        </div>
    </div>
</section>
<?php if ($work->photo): ?>
    <section class="white same-color-as-previous-section">
        <div class="container clearfix">
            <div class="col-lg-12">
                <img src="<?= $work->getThumbFileUrl('photo', 'single') ?>" alt="" />
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="white same-color-as-previous-section">
    <div class="container clearfix">
        <div class="col-md-3 col-md-offset-1">
            <h5 class="header"><?= Yii::t('app', 'Client') ?></h5>
            <p><?= $work->client ? Html::encode($work->client) : Yii::t('app', 'None') ?></p>
            <h5 class="header more-margin"><?= Yii::t('app', 'Date') ?></h5>
            <p><?= date('M Y', strtotime($work->date)) ?></p>
            <h5 class="header more-margin"><?= Yii::t('app', 'Category') ?></h5>
            <p><a href="/<?= Yii::$app->language ?>/portfolio/category/<?= $work->category->slug ?>#works" target="_blank"><?= Html::encode($work->category->name) ?></a></p>
        </div>
        <div class="col-md-4">
            <h5 class="header"><?= Yii::t('app', 'Brief') ?></h5>
            <p>
                <?= Yii::$app->formatter->asHtml($data->content, [
                    'Attr.AllowedRel' => array('nofollow'),
                    'HTML.SafeObject' => true,
                    'Output.FlashCompat' => true,
                    'HTML.SafeIframe' => true,
                    'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                ]) ?>
            </p>
            <?php if ($work->link != '#'): ?>
                <p><a href="<?= Html::encode($work->link) ?>" title="" class="arrow" target="_blank"><?= Html::encode($work->link) ?></a></p>
            <?php endif; ?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <h5 class="header"><?= Yii::t('app', 'Skills') ?></h5>
            <ul class="unordered-list">
                <?php $skills = $work->skills ?>
                <?php foreach ($skills as $skill): ?>
                    <li><a target="_blank" href="/<?= Yii::$app->language ?>/portfolio/skill/<?= $skill->slug ?>#works"><?= Html::encode($skill->name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<section>
    <div class="container clearfix">
        <div class="col-md-12 white-text centered extra-padding-bottom">
            <h2 class="header"><?= Yii::t('app', 'Related Projects') ?></h2>
        </div>
    </div>
    <div class="container clearfix">
        <div id="container">
            <?= RelatedWorksWidget::widget([
                'workId' => $work->id,
                'categoryId' => $work->category->id
            ]) ?>
        </div>
    </div>

    <div class="container clearfix">
        <div class="col-md-12 white-text centered">
            <h4><?= Yii::t('app', 'Ready to Start your Project') ?>?</h4>
            <p><a href="/<?= Yii::$app->language ?>/contact" title=""><?= Yii::t('app', 'Contact Me') ?></a></p>
        </div>
    </div>
</section>