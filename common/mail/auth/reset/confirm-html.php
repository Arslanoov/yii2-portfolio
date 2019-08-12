<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user blog\entities\User\User */

$resetLink = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);

?>

<div class="password-reset">
    <p>Привет, <?= Html::encode($user->username) ?>!</p>

    <p>Для восстановления пароля на сайте <a href="http://meteo.dev">meteo.dev</a> необходимо перейти по ссылке:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    Если вы не отправляли запрос на восстановление пароля, то просто проигнорируйте это письмо
</div>
