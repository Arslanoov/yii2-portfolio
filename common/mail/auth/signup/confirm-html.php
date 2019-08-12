<?php

/* @var $this yii\web\View */
/* @var $user \blog\entities\User\User */

use yii\helpers\Html;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->verification_token]);

?>

<div class="password-reset">
    <p>Привет, <?= Html::encode($user->username) ?>!</p>

    <p>Для подтверждения регистрации на сайте <a href="http://meteo.dev">meteo.dev</a> перейдите по ссылке:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>

    Если вы не отправляли запрос на регистрацию на нашем сайте, то просто проигнорируйте это письмо
</div>
