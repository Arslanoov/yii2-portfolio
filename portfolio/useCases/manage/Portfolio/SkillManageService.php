<?php

namespace portfolio\useCases\manage\Portfolio;

use portfolio\entities\Portfolio\Skill;
use portfolio\forms\manage\Portfolio\SkillForm;
use portfolio\repositories\Portfolio\SkillRepository;

class SkillManageService
{
    private $skills;

    public function __construct(SkillRepository $skills)
    {
        $this->skills = $skills;
    }

    public function create(SkillForm $form): Skill
    {
        $skill = Skill::create(
            $form->name,
            $form->slug
        );
        $this->skills->save($skill);
        return $skill;
    }

    public function edit($id, SkillForm $form): void
    {
        $tag = $this->skills->get($id);
        $tag->edit(
            $form->name,
            $form->slug
        );
        $this->skills->save($tag);
    }

    public function delete($id): void
    {
        $tag = $this->skills->get($id);
        $this->skills->remove($tag);
    }
}