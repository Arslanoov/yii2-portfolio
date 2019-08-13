<?php

namespace portfolio\entities\Portfolio\Work;

use yii\db\ActiveRecord;

class SkillAssignments extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%portfolio_skill_assignments}}';
    }

    public static function create($skillId): self
    {
        $assignment = new static();
        $assignment->skill_id = $skillId;
        return $assignment;
    }

    public function isForSkill($id): bool
    {
        return $this->skill_id == $id;
    }
}