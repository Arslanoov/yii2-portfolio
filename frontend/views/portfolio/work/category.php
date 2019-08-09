<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $category blog\entities\Portfolio\Category */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Portfolio') . ' | ' . $category->getSeoTitle();
$this->registerMetaTag(['name' => 'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Portfolio'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = Html::encode($category->name);

?>

<?= $this->render('_text') ?>

<section id="works">

    <?= $this->render('_filters') ?>

    <?= $this->render('_list', [
        'dataProvider' => $dataProvider
    ]) ?>

</section>