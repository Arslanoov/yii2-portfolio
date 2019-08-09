<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\Post\PostForm */

$this->title = 'Создание работ';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Работы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Создание работ';

?>

<div class="work-create">

    <h1>Создание работы</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>