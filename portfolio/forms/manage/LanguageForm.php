<?php

namespace portfolio\forms\manage;

use portfolio\entities\Language;
use yii\base\Model;

class LanguageForm extends Model
{
    public $content;

    private $_lang;

    public function __construct(Language $lang = null, array $config = [])
    {
        if ($lang) {
            $this->content = $lang->content;
            $this->_lang = $lang;
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['content', 'trim'],
            ['content', 'unique', 'targetClass' => Language::class, 'filter' => $this->_lang ? ['<>', 'id', $this->_lang->id] : null],
        ];
    }
}