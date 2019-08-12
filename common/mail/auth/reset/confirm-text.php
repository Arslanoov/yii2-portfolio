<?php

/* @var $this yii\web\View */
/* @var $user blog\entities\User\User */

$resetLink = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);

?>

<p>Привет, <?= $user->username ?>!</p>

<p>Для восстановления пароля на сайте http://meteo.dev необходимо перейти по ссылке:</p>

<?= $resetLink ?>

Если вы не отправляли запрос на восстановление пароля, то просто проигнорируйте это письмо