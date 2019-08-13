<?php

namespace portfolio\readModels\Portfolio;

use portfolio\entities\Portfolio\Work\WorkData;
use RuntimeException;

class WorkDataReadRepository
{
    public function get($id): ?WorkData
    {
        return WorkData::findOne($id);
    }

    public function getContentByLanguage($workId, $langId): ?WorkData
    {
        return WorkData::find()->where(['work_id' => $workId])->andWhere(['lang_id' => $langId])->limit(1)->one();
    }

    public function save(WorkData $user): void
    {
        if (!$user->save()) {
            throw new RuntimeException('Не получилось сохранить описание');
        }
    }

    public function remove(WorkData $user): void
    {
        if (!$user->delete()) {
            throw new RuntimeException('Не получилось удалить описание');
        }
    }
}