<?php

/** @var $this yii\web\View */
/** @var $model blog\forms\manage\Blog\TagForm */

$this->title = 'Обновление умения';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Умения',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление умения';

?>

<div class="skill-update">

    <h1>Обновление умения</h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>