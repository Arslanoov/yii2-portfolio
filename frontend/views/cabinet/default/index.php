<?php

use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;

/** @var $this yii\web\View */
/** @var $user blog\entities\User\User */

$this->title = Yii::t('app', 'Личный Кабинет');

$this->params['breadcrumbs'][] = Yii::t('app', 'Личный Кабинет');

?>

<div class="container padding-bottom">
    <div class="row little-padding">
        <h1>Cabinet</h1>

        <div class="row little-padding-top">
            <?php if ($user->photo): ?>
                <div class="col-md-4 col-sm-12">
                    <div class="text-left">
                        <p>
                            <?= Html::a(Html::img($user->getThumbFileUrl('photo', 'thumb')), $user->getUploadedFileUrl('photo'), [
                                'target' => '_blank'
                            ]) ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-4 col-sm-12">
                <h2><?= Yii::t('app', 'Изменить аккаунт') ?></h2>
                <p>
                    <?= Html::a(Yii::t('app', 'Изменить'), ['/' . Yii::$app->language . '/cabinet/edit'], ['class' => 'btn btn-success']) ?>
                </p>

                <h2><?= Yii::t('app', 'Удалить аккаунт') ?></h2>
                <?= Html::a(Yii::t('app', 'Удалить'), ['/' . Yii::$app->language . '/cabinet/delete'], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Html::encode($user->username) . ', вы действительно хотите удалить свой аккаунт? Это действия нельзя будет предотвратить!',
                        'method' => 'post',
                    ]
                ]) ?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12">
                <b>ID:</b>
                <p><?= $user->id ?></p>

                <b><?= Yii::t('app', 'Имя') ?>:</b>
                <p><?= Html::encode($user->username) ?></p>

                <b><?= Yii::t('app', 'Почта') ?>:</b>
                <p><?= Html::encode($user->email) ?></p>

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