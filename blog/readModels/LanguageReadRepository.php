<?php

namespace blog\readModels;

use blog\entities\Language;

class LanguageReadRepository
{
    public function getByContent($content): ?Language
    {
        return Language::find()->where(['content' => $content])->limit(1)->one();
    }
}