<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\User\UserEditForm */
/* @var $user blog\entities\User\User */

$this->title = Yii::t('app', 'Личный Кабинет') . ' | ' . Yii::t('app', 'Изменение данных');

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Личный Кабинет'),
    'url' => ['/cabinet/default/index']
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменение данных');

?>

<div class="user-update">

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">

                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'username')->textInput(['maxLength' => true, 'value' => Yii::$app->user->identity->getUsername()]) ?>
                    <?= $form->field($model, 'aboutMe')->textarea(['rows' => '9', 'value' => Yii::$app->user->identity->getAboutMe()]) ?>
                    <?= $form->field($model, 'photo')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>