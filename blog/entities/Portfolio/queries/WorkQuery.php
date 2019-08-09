<?php

namespace blog\entities\Portfolio\queries;

use blog\entities\Portfolio\Work\Work;
use yii\db\ActiveQuery;

class WorkQuery extends ActiveQuery
{
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Work::STATUS_ACTIVE
        ]);
    }
}