<?php

use frontend\widgets\PortfolioCategoriesWidget;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $skill blog\entities\Portfolio\Skill */

$this->title = Html::encode($skill->name);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Portfolio'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = Html::encode($skill->name);

?>

<?= $this->render('_text') ?>

<section id="works">

    <?= $this->render('_filters') ?>

    <?= $this->render('_list', [
        'dataProvider' => $dataProvider
    ]) ?>

</section>