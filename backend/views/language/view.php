<?php

use portfolio\helpers\UserHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model \blog\entities\Language */

$this->title = 'Просмотр языка';

$this->params['breadcrumbs'][] = [
    'label' => 'Языки',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр языка';

?>

<div class="language-view">

    <h1>Просмотр языка</h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действтельно хотите удалить этот язык?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'content',
                        'label' => 'Содержание'
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
