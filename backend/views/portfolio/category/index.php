<?php

use blog\entities\Portfolio\Work\Work;
use blog\helpers\PostHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Portfolio\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Работы';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = 'Работы';

?>

<div class="category-index">

    <h1>Категории</h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
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
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],

                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>