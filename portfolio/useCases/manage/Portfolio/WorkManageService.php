<?php

namespace portfolio\useCases\manage\Portfolio;

use portfolio\entities\Meta;
use portfolio\entities\Portfolio\Skill;
use portfolio\entities\Portfolio\Work\Work;
use portfolio\forms\manage\Portfolio\Work\WorkForm;
use portfolio\repositories\Portfolio\CategoryRepository;
use portfolio\repositories\Portfolio\SkillRepository;
use portfolio\repositories\Portfolio\WorkRepository;
use portfolio\services\TransactionManager;
use yii\helpers\Inflector;

class WorkManageService
{
    private $works;
    private $categories;
    private $skills;
    private $transaction;

    public function __construct(WorkRepository $works, CategoryRepository $categories, SkillRepository $skills, TransactionManager $transaction)
    {
        $this->works = $works;
        $this->categories = $categories;
        $this->skills = $skills;
        $this->transaction = $transaction;
    }

    public function create(WorkForm $form): Work
    {
        $category = $this->categories->get($form->categoryId);

        $work = Work::create(
            $category->id,
            $form->date,
            $form->link,
            Inflector::slug($form->title),
            $form->title,
            $form->client,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        if ($form->photo) {
            $work->setPhoto($form->photo);
        }

        foreach ($form->skills->existing as $skillId) {
            $skill = $this->skills->get($skillId);
            $work->assignSkill($skill->id);
        }

        $this->transaction->wrap(function () use ($work, $form) {
            foreach ($form->skills->newNames as $tagName) {
                if (!$skill = $this->skills->findByName($tagName)) {
                    $skill = Skill::create($tagName, $tagName);
                    $this->skills->save($skill);
                }
                $work->assignSkill($skill->id);
            }

            $this->works->save($work);
        });

        return $work;
    }

    public function edit($id, WorkForm $form): void
    {
        $work = $this->works->get($id);
        $category = $this->categories->get($form->categoryId);

        $work->edit(
            $category->id,
            $form->date,
            $form->link,
            Inflector::slug($form->title),
            $form->title,
            $form->client,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        if ($form->photo) {
            $work->setPhoto($form->photo);
        }

        foreach ($form->skills->existing as $skillId) {
            $skill = $this->skills->get($skillId);
            $work->assignSkill($skill->id);
        }

        $this->transaction->wrap(function () use ($work, $form) {
            foreach ($form->skills->newNames as $tagName) {
                if (!$skill = $this->skills->findByName($tagName)) {
                    $skill = Skill::create($tagName, $tagName);
                    $this->skills->save($skill);
                }
                $work->assignSkill($skill->id);
            }

            $this->works->save($work);
        });
    }
    
    public function remove($id): void 
    {
        $work = $this->works->get($id);
        $this->works->delete($work);
    }

    public function activate($id): void
    {
        $work = $this->works->get($id);
        $work->activate();
        $this->works->save($work);
    }

    public function draft($id): void
    {
        $work = $this->works->get($id);
        $work->draft();
        $this->works->save($work);
    }
}