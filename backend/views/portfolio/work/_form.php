<?php

use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\elfinder\ElFinder;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Portfolio\Work\WorkForm */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="work-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model, 'categoryId')->dropDownList($model->categoriesList(), ['prompt' => ''])->label('Категория') ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Навыки</div>
                <div class="box-body">
                    <?= $form->field($model->skills, 'existing')->checkboxList($model->skills->skillsList())->label('Существующие') ?>
                    <?= $form->field($model->skills, 'textNew')->textInput()->label('Новые (через запятую)') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'date')->textInput(['maxlength' => true])->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Выберите дату ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'language' => 'en',
                    'dateFormat' => 'yyyy-MM-dd'
                ]
            ])->label('Дата') ?>
            <?= $form->field($model, 'link')->textInput(['maxlength' => true])->label('Ссылка') ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>
            <?= $form->field($model, 'client')->textarea(['rows' => 5])->label('Клиент') ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Фотография</div>
        <div class="box-body">
            <?= $form->field($model, 'photo')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput()->label('SEO Заголовок') ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2])->label('SEO Описание') ?>
            <?= $form->field($model->meta, 'keywords')->textInput()->label('SEO Ключевые Слова') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>