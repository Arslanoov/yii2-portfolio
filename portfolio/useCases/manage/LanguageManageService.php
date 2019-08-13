<?php

namespace portfolio\useCases\manage;

use portfolio\entities\Language;
use portfolio\forms\manage\LanguageForm;
use portfolio\repositories\LanguageRepository;

class LanguageManageService
{
    private $languages;

    public function __construct(LanguageRepository $languages)
    {
        $this->languages = $languages;
    }

    public function create(LanguageForm $form): Language
    {
        $lang = Language::create(
            $form->content
        );

        $this->languages->save($lang);

        return $lang;
    }

    public function edit($id, LanguageForm $form): void
    {
        $lang = $this->languages->get($id);

        $lang->edit(
            $form->content
        );

        $this->languages->save($lang);
    }

    public function remove($id): void
    {
        $user = $this->languages->get($id);
        $this->languages->remove($user);
    }
}