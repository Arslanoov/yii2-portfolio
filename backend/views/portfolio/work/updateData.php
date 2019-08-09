<?php

/** @var $this yii\web\View */
/** @var $model \blog\forms\manage\Portfolio\Work\WorkDataForm */
/** @var $workId int */

$this->title = 'Создание описания';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Работы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => 'Просмотр работы',
    'url' => ['view', 'id' => $workId]
];
$this->params['breadcrumbs'][] = 'Обновление описания';

?>

<div class="work-data-create">

    <h1>Обновление описания</h1>

    <?= $this->render('_dataForm', [
        'model' => $model
    ]) ?>

</div>