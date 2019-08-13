<?php

/* @var $this yii\web\View */
/* @var $work blog\entities\Portfolio\Work\Work */

use portfolio\helpers\WorkHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Просмотр работы';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Работы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр работы';

?>

<div class="work-view">

    <h1>Просмотр работы</h1>

    <p>
        <?php if ($work->isActive()): ?>
            <?= Html::a('Деактивировать', ['draft', 'id' => $work->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Активировать', ['activate', 'id' => $work->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Обновить', ['update', 'id' => $work->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $work->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту работу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $work,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'status',
                        'value' => WorkHelper::statusLabel($work->status),
                        'format' => 'raw',
                        'label' => 'Статус'
                    ],
                    [
                        'attribute' => 'date',
                        'label' => 'Дата',
                        'format' => 'date'
                    ],
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],
                    [
                        'attribute' => 'link',
                        'label' => 'Ссылка'
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг'
                    ],
                    [
                        'attribute' => 'category_id',
                        'value' => ArrayHelper::getValue($work, 'category.name'),
                        'label' => 'Категория'
                    ],
                    [
                        'label' => 'Умения',
                        'value' => implode(', ', ArrayHelper::getColumn($work->skills, 'name')),
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Фотография</div>
        <div class="box-body">
            <?php if ($work->photo): ?>
                <?= Html::a(Html::img($work->getThumbFileUrl('photo', 'thumb')), $work->getUploadedFileUrl('photo'), [
                    'class' => 'thumbnail',
                    'target' => '_blank'
                ]) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Содержание</div>
        <div class="box-body">
            <?= Html::a('Добавить', ['create-data', 'workId' => $work->id], ['class' => 'btn btn-success']) ?>
            <br><br>

            <?php foreach ($work->data as $data): ?>
                <hr>

                <p>
                    <b>Язык: <?= Html::encode($data->language->content) ?></b> <br>

                    <?= Yii::$app->formatter->asHtml($data->content, [
                        'Attr.AllowedRel' => array('nofollow'),
                        'HTML.SafeObject' => true,
                        'Output.FlashCompat' => true,
                        'HTML.SafeIframe' => true,
                        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?>
                </p>


                <?= Html::a('Обновить', ['update-data', 'workId' => $work->id, 'langId' => $data->language->id, 'dataId' => $data->id], ['class' => 'btn btn-primary']) ?>

                <hr>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $work,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'label' => 'SEO Заголовок',
                        'value' => $work->meta->title,
                    ],
                    [
                        'attribute' => 'meta.description',
                        'label' => 'SEO Описание',
                        'value' => $work->meta->description,
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'label' => 'SEO Ключевые Слова',
                        'value' => $work->meta->keywords,
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>