<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Portfolio');

$this->params['breadcrumbs'][] = Yii::t('app', 'Portfolio');

?>

<?= $this->render('_text') ?>

<section id="works">

    <?= $this->render('_filters') ?>

    <?= $this->render('_list', [
        'dataProvider' => $dataProvider
    ]) ?>

</section>