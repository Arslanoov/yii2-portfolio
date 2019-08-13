<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Portfolio\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use portfolio\entities\Portfolio\Work\Work;
use portfolio\helpers\WorkHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;

$this->title = 'Работы';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = 'Работы';

?>

<div class="work-index">

    <h1>Работы</h1>

    <p>
        <?= Html::a('Создать работу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'options' => ['class' => 'table-responsive'],
                'tableOptions' => ['class' => 'table table-condensed'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'value' => function (Work $model) {
                            return $model->photo ? Html::img($model->getThumbFileUrl('photo', 'admin')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                        'label' => 'Фотография'
                    ],
                    'id',
                    [
                        'attribute' => 'category',
                        'filter' => $searchModel->categoriesList(),
                        'value' => 'category.name',
                        'label' => 'Категория'
                    ],
                    [
                        'attribute' => 'date',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ]),
                        'format' => 'datetime',
                        'label' => 'Дата'
                    ],
                    [
                        'attribute' => 'link',
                        'label' => 'Ссылка'
                    ],
                    [
                        'attribute' => 'title',
                        'value' => function (Work $model) {
                            return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                        'label' => 'Заголовок'
                    ],
                    [
                        'attribute' => 'client',
                        'label' => 'Клиент'
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Work $model) {
                            return WorkHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                        'label' => 'Статус'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>