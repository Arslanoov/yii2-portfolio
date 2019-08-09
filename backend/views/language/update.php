<?php

/* @var $this yii\web\View */
/* @var $model \blog\forms\manage\LanguageForm */

$this->title = 'Обновление языка';

$this->params['breadcrumbs'][] = [
    'label' => 'Языки',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление языка';

?>

<div class="language-update">

    <h1>Обновление языка</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>