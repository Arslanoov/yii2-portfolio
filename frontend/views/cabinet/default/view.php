<?php

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $user blog\entities\User\User */

$this->title = Yii::t('app', 'Пользователь') . ' | ' . Html::encode($user->username);

$this->params['breadcrumbs'][] = Yii::t('app', 'Пользователь');
$this->params['breadcrumbs'][] = Html::encode($user->username);

?>

<div class="container padding-bottom">
    <div class="row little-padding">
        <h1><?= Yii::t('app', 'Пользователь') . ' №' . $user->id ?></h1>

        <div class="row little-padding-top">
            <?php if ($user->photo): ?>
                <div class="col-sm-6">
                    <div class="text-left">
                        <p>
                            <?= Html::a(Html::img($user->getThumbFileUrl('photo', 'thumb')), $user->getUploadedFileUrl('photo'), [
                                'target' => '_blank'
                            ]) ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-sm-6">
                <h5><?= Yii::$app->authManager->checkAccess($user->id, 'admin') ? ('(' . Yii::t('app', 'Администратор') . ')') : '' ?></h5>

                <b>ID:</b>
                <p><?= $user->id ?></p>

                <b><?= Yii::t('app', 'Имя') ?>:</b>
                <p><?= Html::encode($user->username) ?></p>

                <b><?= Yii::t('app', 'Создан') ?>:</b>
                <p><?= date('Y-m-d H:i:s', $user->created_at) ?></p>

                <b><?= Yii::t('app', 'Обновлен') ?>:</b>
                <p><?= date('Y-m-d H:i:s', $user->updated_at) ?></p>

                <b><?= Yii::t('app', 'Обо мне') ?>:</b>
                <p><?= Html::encode($user->about_me) ?></p>
            </div>
        </div>
    </div>
</div>