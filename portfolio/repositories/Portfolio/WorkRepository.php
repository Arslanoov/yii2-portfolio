<?php

namespace portfolio\repositories\Portfolio;

use portfolio\entities\Portfolio\Work\Work;
use portfolio\repositories\NotFoundException;
use DomainException;

class WorkRepository
{
    public function get($id): ?Work
    {
        return $this->getBy(['id' => $id]);
    }

    public function existsByCategory($id): bool
    {
        return Work::find()->where(['category_id' => $id])->exists();
    }

    public function findByCategoryId($categoryId): array
    {
        return Work::find()->where(['category_id' => $categoryId])->all();
    }

    public function save(Work $work): void
    {
        if (!$work->save()) {
            throw new DomainException('Не удалось сохранить работу');
        }
    }

    public function delete(Work $work): void
    {
        if (!$work->delete()) {
            throw new DomainException('Не удалось удалить работу');
        }
    }

    private function getBy(array $condition): ?Work
    {
        if (!($work = Work::find()->where($condition)->one())) {
            throw new NotFoundException('Работа не найдена');
        }
        return $work;
    }
}