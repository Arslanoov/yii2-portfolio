<?php

namespace portfolio\forms\User;

use portfolio\entities\User\User;
use yii\base\Model;
use yii\web\UploadedFile;

class ProfileEditForm extends Model
{
    public $photo;
    public $username;
    public $email;
    public $aboutMe;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->aboutMe = $user->about_me;
        $this->_user = $user;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['photo', 'image'],
            [['username', 'email'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
            ['aboutMe', 'string', 'max' => 500]
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }
}