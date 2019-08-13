<?php

namespace portfolio\entities\User\events;

use portfolio\entities\User\User;

class UserSignUpRequested
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}