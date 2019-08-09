<?php

namespace blog\readModels\Portfolio;

use blog\entities\Portfolio\Skill;
use blog\entities\Portfolio\Work\Work;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class WorkReadRepository
{
    public function count(): int
    {
        return Work::find()->active()->count();
    }

    public function getRelatedWorks($workId, $categoryId, $limit): array
    {
        return Work::find()->where(['category_id' => $categoryId])->andWhere(['!=', 'id', $workId])->limit($limit)->active()->all();
    }

    public function getLast($limit): array
    {
        return Work::find()->orderBy(['id' => SORT_DESC])->limit($limit)->active()->all();
    }

    public function getAllByRange($offset, $limit): array
    {
        return Work::find()->active()->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    public function find($id): ?Work
    {
        return Work::find()->where(['id' => $id])->active()->one();
    }

    public function findBySlug(string $slug): ?Work
    {
        return Work::find()->where(['slug' => $slug])->active()->one();
    }

    public function getAll(): ActiveDataProvider
    {
        $query = Work::find()->orderBy(['date' => SORT_DESC])->active()->with('category');
        return $this->getProvider($query);
    }

    public function getAllByCategory($categoryId): ActiveDataProvider
    {
        $query = Work::find()->where(['category_id' => $categoryId])->orderBy(['date' => SORT_DESC])->active()->with('category');
        return $this->getProvider($query);
    }

    public function getAllBySkill(Skill $skill): DataProviderInterface
    {
        $query = Work::find()->alias('p')->active('p')->with('category');
        $query->joinWith(['skillAssignments sk'], false);
        $query->andWhere(['sk.skill_id' => $skill->id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => ['id'],
            ],
            'pagination' => [
                'pageSize' => 4,
                'pageSizeParam' => false
            ]
        ]);
    }
}