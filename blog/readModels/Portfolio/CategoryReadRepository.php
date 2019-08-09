<?php

namespace blog\readModels\Portfolio;

use blog\entities\Portfolio\Category;
use yii\caching\FileCache;

class CategoryReadRepository
{
    private $cache;

    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }

    public function findAll(): array
    {
        return Category::find()->all();
    }

    public function findBySlug($slug)
    {
        return Category::find()->where(['slug' => $slug])->one();
    }
}