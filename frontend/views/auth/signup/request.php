<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model blog\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

$this->title = Yii::t('app', 'Sign Up');
$this->params['breadcrumbs'][] = Yii::t('app', 'Sign Up');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <h1><?= Yii::t('app', 'Sign Up') ?></h1>

            <p><?= Yii::t('app', 'Please enter your registration information') ?></p>

            <?php $form = ActiveForm::begin([
                'id' => 'contactform',
                'options' => [
                    'class' => 'form-part'
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('app', 'Username')) ?>
            <?= $form->field($model, 'email')->label(Yii::t('app', 'E-mail')) ?>
            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>
            <?= $form->field($model, 'aboutMe')->textarea(['rows' => '8'])->label(Yii::t('app', 'About Me')) ?>
            <?= $form->field($model, 'photo')->label(Yii::t('app', 'Photo'))->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                ],
            ]) ?>

            <?= Html::submitButton(Yii::t('app', 'Sign Up'), ['class' => 'button']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
