<?php

namespace portfolio\forms\manage\Portfolio\Work;

use portfolio\entities\Portfolio\Skill;
use portfolio\entities\Portfolio\Work\Work;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class SkillsForm extends Model
{
    public $existing = [];
    public $textNew;

    public function __construct(Work $work = null, $config = [])
    {
        if ($work) {
            $this->existing = ArrayHelper::getColumn($work->skillAssignments, 'skill_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
            ['existing', 'default', 'value' => []],
        ];
    }

    public function skillsList(): array
    {
        return ArrayHelper::map(Skill::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function getNewNames(): array
    {
        return array_filter(array_map('trim', preg_split('#\s*,\s*#i', $this->textNew)));
    }
}