<?php

namespace blog\entities\Portfolio;

use yii\db\ActiveRecord;

class Skill extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%portfolio_skills}}';
    }

    public static function create($name, $slug): self
    {
        $skill = new static();
        $skill->name = $name;
        $skill->slug = $slug;
        return $skill;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }
}