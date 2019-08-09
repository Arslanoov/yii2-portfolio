<?php

namespace blog\entities\Portfolio;

use blog\entities\behaviors\MetaBehavior;
use blog\entities\Meta;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public $meta;

    public static function tableName(): string
    {
        return '{{%portfolio_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class
        ];
    }

    public static function create(string $name, string $slug, string $title, $description, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;
        return $category;
    }

    public function edit(string $name, string $slug, string $title, $description, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?? $this->name;
    }
}