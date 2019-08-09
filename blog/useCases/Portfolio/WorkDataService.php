<?php

namespace blog\useCases\Portfolio;

use blog\forms\manage\Portfolio\Work\WorkDataForm;
use blog\readModels\LanguageReadRepository;
use blog\readModels\Portfolio\WorkDataReadRepository;
USE blog\entities\Portfolio\Work\WorkData;

class WorkDataService
{
    private $languages;
    private $worksData;

    public function __construct(LanguageReadRepository $languages, WorkDataReadRepository $worksData)
    {
        $this->languages = $languages;
        $this->worksData = $worksData;
    }

    public function getContentByLanguage($workId, $lang)
    {
        $languageId = $this->languages->getByContent($lang);
        return $this->worksData->getContentByLanguage($workId, $languageId);
    }

    public function create(WorkDataForm $form, $workId): WorkData
    {
        $workData = WorkData::create(
            $workId,
            $form->lang_id,
            $form->content
        );

        $this->worksData->save($workData);

        return $workData;
    }

    public function edit(WorkDataForm $form, $dataId): void
    {
        $workData = $this->worksData->get($dataId);

        $workData->edit(
            $form->content
        );

        $this->worksData->save($workData);
    }

    public function remove($id): void
    {
        $workData = $this->worksData->get($id);
        $this->worksData->remove($workData);
    }
}