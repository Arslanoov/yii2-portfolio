<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Языки';

$this->params['breadcrumbs'][] = 'Языки';

?>

<div class="language-index">

    <h1>Языки</h1>

    <p>
        <?= Html::a('Создать язык', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'attribute' => 'content',
                        'label' => 'Содержание'
                    ],

                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
