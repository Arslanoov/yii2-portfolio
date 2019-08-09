<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\Post\PostForm */

$this->title = 'Обновление работ';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Работы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление работ';

?>

<div class="work-update">

    <h1>Обновление работы</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>