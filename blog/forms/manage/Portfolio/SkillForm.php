<?php

namespace blog\forms\manage\Portfolio;

use blog\entities\Portfolio\Skill;
use blog\validators\SlugValidator;
use yii\base\Model;

class SkillForm extends Model
{
    public $name;
    public $slug;

    private $_skill;

    public function __construct(Skill $skill = null, array $config = [])
    {
        if ($skill) {
            $this->name = $skill->name;
            $this->slug = $skill->slug;
            $this->_skill = $skill;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            ['name', 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Skill::class, 'filter' => $this->_skill ? ['<>', 'id', $this->_skill->id] : null],
        ];
    }
}