<?php

namespace portfolio\useCases\auth;

use portfolio\repositories\UserRepository;
use portfolio\forms\auth\LoginForm;
use portfolio\entities\User\User;
use DomainException;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->validatePassword($form->password)) {
            throw new DomainException('Неверное имя пользователя или пароль.');
        }
        if ($user->isBanned()) {
            throw new DomainException('Пользователь забанен за нарушение правил сайта');
        }
        if (!$user->isActive()) {
            throw new DomainException('Пользователь не активирован');
        }

        return $user;
    }
}