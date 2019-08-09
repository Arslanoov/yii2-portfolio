<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\PageForm */

$this->title = 'Создание языка';

$this->params['breadcrumbs'][] = [
    'label' => 'Языки',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Создание языка';

?>

<div class="language-create">

    <h1>Создание языка</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>