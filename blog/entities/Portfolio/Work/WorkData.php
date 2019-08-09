<?php

namespace blog\entities\Portfolio\Work;

use blog\entities\Language;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class WorkData extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%work_data}}';
    }

    public static function create($workId, $languageId, $content): self
    {
        $data = new static();
        $data->work_id  = $workId;
        $data->lang_id = $languageId;
        $data->content = $content;
        return $data;
    }

    public function edit($content): void
    {
        $this->content = $content;
    }

    public function getLanguage(): ActiveQuery
    {
        return $this->hasOne(Language::class, ['id' => 'lang_id']);
    }
}