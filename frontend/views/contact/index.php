<?php

/** @var $this yii\web\View */
/** @var $model blog\forms\ContactForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Contact');

?>

<div class="full-width intro">
    <div class="full-height not-completely-full">
        <div class="fixed">
            <div id="map" class="parallax parallax-banner background-map">
            </div>
        </div>
        <div class="full-height-wrapper white-text">
            <div class="parent">
                <div class="bottom">
                    <div class="container">
                        <div class="animatedblock delay2 animatedUp">
                            <div class="col-md-7 col-md-offset-1">
                                <div class="banner-textblock">
                                    <h1 class="header"><?= Yii::t('app', 'Contact') ?> <br>
                                    <?= Yii::t('app', 'With Me') ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay contact-map-overlay"></div>
        </div>
    </div>
</div>

<section class="white">
    <div class="container clearfix">

        <div class="col-md-7 col-md-offset-1 col-sm-6 extra-padding-right">
            <?php $form = ActiveForm::begin([
                'id' => 'contactform',
                'options' => [
                    'class' => 'form-part'
                ],
            ]) ?>

                <?= $form->field($model, 'username')->textInput([
                    'id' => 'name',
                    'placeholder' => Yii::t('app', 'Name'),
                    'value' => (!Yii::$app->user->isGuest ? Yii::$app->user->identity->getUsername() : '')
                ])->label(false) ?>

                <?= $form->field($model, 'email')->textInput([
                    'id' => 'email',
                    'placeholder' => Yii::t('app', 'Email'),
                    'value' => (!Yii::$app->user->isGuest ? Yii::$app->user->identity->getEmail() : '')
                ])->label(false) ?>

                <?= $form->field($model, 'message')->textarea([
                    'cols' => 40,
                    'rows' => 3,
                    'placeholder' => Yii::t('app', 'Your message'),
                    'id' => 'comments'
                ])->label(false) ?>

            <div class="input-wrapper clearfix">
                <span id="message"></span>
                <div class="clear"></div>

                <?= Html::submitButton(Yii::t('app', 'Submit'), [
                    'class' => 'button'
                ]) ?>

            </div>

            <?php ActiveForm::end() ?>

        </div>
        <div class="col-md-3 col-sm-6">
            <h3 class="header"><?= Yii::t('app', "I'll get back to you as soon as possible") ?></h3>

            <div class="break"></div>

            <h5 class="small below-text">E-mail</h5> <br>
            <span class="large"><a href="mailto:rasularslanoov@gmail.com">rasularslanoov@gmail.com</a></span>

            <div class="break"></div>

            <h5 class="small below-text">Telegram</h5> <br>
            <span class="large"><a href="https://t.me/rasularslanoov">@rasularslanoov</a></span>
        </div>
    </div>
</section>