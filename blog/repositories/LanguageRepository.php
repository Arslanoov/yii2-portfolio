<?php

namespace blog\repositories;

use blog\entities\Language;
use RuntimeException;

class LanguageRepository
{
    public function get($id): Language
    {
        return Language::findOne($id);
    }

    public function save(Language $user): void
    {
        if (!$user->save()) {
            throw new RuntimeException('Не получилось сохранить язык');
        }
    }

    public function remove(Language $user): void
    {
        if (!$user->delete()) {
            throw new RuntimeException('Не получилось удалить язык');
        }
    }
}