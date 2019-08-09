<?php

namespace blog\entities;

use blog\entities\Portfolio\Work\WorkData;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Language extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%languages}}';
    }

    public static function create($content): self
    {
        $language = new static();
        $language->content = $content;
        return $language;
    }

    public function edit($content): void
    {
        $this->content = $content;
    }

    public function getWorksData(): ActiveQuery
    {
        return $this->hasMany(WorkData::class, ['lang_id' => 'id']);
    }
}