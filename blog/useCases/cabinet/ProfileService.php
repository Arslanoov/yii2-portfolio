<?php

namespace blog\useCases\cabinet;

use blog\forms\User\ProfileEditForm;
use blog\repositories\UserRepository;

class ProfileService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function edit($id, ProfileEditForm $form)
    {
        $user = $this->users->get($id);
        $user->editProfile(
            $form->username,
            $form->aboutMe
        );

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->users->save($user);
    }
}