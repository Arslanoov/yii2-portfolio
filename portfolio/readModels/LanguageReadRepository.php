<?php

namespace portfolio\readModels;

use portfolio\entities\Language;

class LanguageReadRepository
{
    public function getByContent($content): ?Language
    {
        return Language::find()->where(['content' => $content])->limit(1)->one();
    }
}