<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $page blog\entities\Page */

$this->title = $page->getSeoTitle();
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta->keywords]);

foreach ($page->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = [
            'label' => $parent->title, 'url' => ['view', 'id' => $parent->id]
        ];
    }
}
$this->params['breadcrumbs'][] = $page->title;

?>

<div class="container">
    <div class="row">
        <article class="padding-content">

            <h1><?= Html::encode($page->title) ?></h1>

            <?= $page->content ?>

        </article>
    </div>
</div>