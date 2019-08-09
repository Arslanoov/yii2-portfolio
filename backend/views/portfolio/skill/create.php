<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\TagForm */

$this->title = 'Создание умения';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Умения',
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = 'Создание умения';

?>

<div class="skill-create">

    <h1>Создание умения</h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
