<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Portfolio\CategoryForm */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>
            <?= $form->field($model, 'description')->widget(CKEditor::class, [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ])->label('Описание') ?>
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