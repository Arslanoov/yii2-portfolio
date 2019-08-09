<?php

/** @var $this \yii\web\View */
/** @var $model \blog\forms\manage\Portfolio\Work\WorkDataForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

?>


<div class="work-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model, 'lang_id')->dropDownList($model->languagesList(), ['prompt' => ''])->label('Язык') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'content')->widget(CKEditor::class, [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ])->label('Содержание') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>