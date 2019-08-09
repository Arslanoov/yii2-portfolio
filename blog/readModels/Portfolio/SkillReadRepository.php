<?php

namespace blog\readModels\Portfolio;

use blog\entities\Portfolio\Skill;
use yii\caching\FileCache;

class SkillReadRepository
{
    private $cache;

    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }

    public function findAll(): array
    {
        return Skill::find()->all();
    }

    public function findBySlug($slug): ?Skill
    {
        return Skill::find()->where(['slug' => $slug])->one();
    }
}