<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Blog\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Умения';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = 'Умения';

?>

<div class="skill-index">

    <h1>Метки</h1>

    <p>
        <?= Html::a('Создать метку', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'options' => ['class' => 'table-responsive'],
                'tableOptions' => ['class' => 'table table-condensed'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'label' => 'Имя'
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг'
                    ],

                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>

</div>
