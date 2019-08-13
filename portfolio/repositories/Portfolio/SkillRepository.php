<?php

namespace portfolio\repositories\Portfolio;

use portfolio\entities\Portfolio\Skill;
use portfolio\repositories\NotFoundException;
use DomainException;

class SkillRepository
{
    public function get($id): ?Skill
    {
        return $this->getBy(['id' => $id]);
    }

    public function findByName($name): ?Skill
    {
        return Skill::findOne(['name' => $name]);
    }

    public static function save(Skill $skill): void
    {
        if (!$skill->save()) {
            throw new DomainException('Не удалось сохранить умение');
        }
    }

    public static function delete(Skill $skill): void
    {
        if (!$skill->delete()) {
            throw new DomainException('Не удалось удалить умение');
        }
    }

    private function getBy(array $condition): ?Skill
    {
        if (!($skill = Skill::findOne($condition))) {
            throw new NotFoundException('Умение не найдено');
        }
        return $skill;
    }
}