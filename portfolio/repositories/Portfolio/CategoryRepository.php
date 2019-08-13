<?php

namespace portfolio\repositories\Portfolio;

use portfolio\entities\Portfolio\Category;
use DomainException;
use portfolio\repositories\NotFoundException;

class CategoryRepository
{
    public function get($id): ?Category
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new DomainException('Не удалось сохранить категорию');
        }
    }

    public function delete(Category $category): void
    {
        if (!$category->delete()) {
            throw new DomainException('Не удалось удалить категорию');
        }
    }

    private function getBy(array $condition): ?Category
    {
        if (!($category = Category::find()->where($condition)->one())) {
            throw new NotFoundException('Категория не найдена');
        }
        return $category;
    }
}