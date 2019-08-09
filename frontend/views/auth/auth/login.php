<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \blog\entities\User\User */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Вход');
$this->params['breadcrumbs'][] = Yii::t('app', 'Вход');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <h1 class="title"><?= Yii::t('app', 'Login') ?></h1>

            <p><?= Yii::t('app', 'Enter your account information to login') ?></p>

            <?php $form = ActiveForm::begin([
                'id' => 'contactform',
                'options' => [
                    'class' => 'form-part'
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('app', 'Username')) ?>
            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>
            <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app', 'Remember Me')) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
