<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $this \yii\web\View */
/** @var $model \blog\forms\manage\Portfolio\SkillForm */

$this->title = 'Просмотр умения';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Умения',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр умения';

?>

<div class="skill-view">

    <h1>Просмотр умения</h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'label' => 'Имя'
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг'
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>