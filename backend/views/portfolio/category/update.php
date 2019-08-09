<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Portfolio\CategoryForm */

$this->title = 'Обновление категории';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Категории',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление категории';

?>

<div class="category-update">

    <h1>Обновление категории</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>