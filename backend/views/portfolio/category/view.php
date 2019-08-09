<?php

use blog\helpers\PostHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $category blog\entities\Portfolio\Category */

$this->title = 'Просмотр категории';

$this->params['breadcrumbs'][] = 'Портфолио';
$this->params['breadcrumbs'][] = [
    'label' => 'Категории',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр категории';

?>

<div class="category-view">

    <h1>Просмотр категории</h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $category->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $category->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту категорию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $category,
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
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Описание</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($category->description, [
                'Attr.AllowedRel' => array('nofollow'),
                'HTML.SafeObject' => true,
                'Output.FlashCompat' => true,
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $category,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'label' => 'SEO Заголовок'
                    ],
                    [
                        'attribute' => 'meta.description',
                        'label' => 'SEO Описание'
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'label' => 'SEO Ключевые Слова'
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>