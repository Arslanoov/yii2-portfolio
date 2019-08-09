<?php

namespace blog\forms\manage\Portfolio\Work;

use blog\entities\Language;
use blog\entities\Portfolio\Work\WorkData;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class WorkDataForm extends Model
{
    public $lang_id;
    public $content;

    private $_workData;

    public function __construct(WorkData $workData = null, array $config = [])
    {
        if ($workData) {
            $this->lang_id = $workData->lang_id;
            $this->content = $workData->content;
            $this->_workData = $workData;
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['content', 'trim'],
            ['lang_id', 'integer'],
        ];
    }

    public function languagesList(): array
    {
        return ArrayHelper::map(Language::find()->asArray()->all(), 'id', 'content');
    }

}