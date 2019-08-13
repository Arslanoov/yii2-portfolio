<?php

namespace common\bootstrap;

use portfolio\dispatchers\DeferredEventDispatcher;
use portfolio\dispatchers\EventDispatcher;
use portfolio\listeners\User\UserSignUpRequestedListener;
use portfolio\useCases\ContactService;
use portfolio\dispatchers\SimpleEventDispatcher;
use portfolio\listeners\User\UserSignUpConfirmedListener;
use Yii;
use yii\base\BootstrapInterface;
use yii\di\Container;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;
use portfolio\entities\User\events\UserSignUpRequested;
use portfolio\entities\User\events\UserSignUpConfirmed;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(EventDispatcher::class, DeferredEventDispatcher::class);
        $container->setSingleton(DeferredEventDispatcher::class, function (Container $container) {
            return new DeferredEventDispatcher(new SimpleEventDispatcher($container, [
                UserSignUpRequested::class => [UserSignupRequestedListener::class],
                UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
            ]));
        });

        return new SimpleEventDispatcher($container, [
            UserSignUpRequested::class => [UserSignupRequestedListener::class],
            UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
        ]);
    }
}