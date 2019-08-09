<?php

namespace blog\forms\manage\Portfolio\Work;

use blog\entities\Portfolio\Category;
use blog\entities\Portfolio\Work\Work;
use blog\forms\CompositeForm;
use blog\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class WorkForm extends CompositeForm
{
    public $categoryId;
    public $date;
    public $link;
    public $title;
    public $client;
    public $photo;
    public $status;

    private $_work;

    public function __construct(Work $work = null, array $config = [])
    {
        if ($work) {
            $this->categoryId = $work->category_id;
            $this->date = $work->date;
            $this->link = $work->link;
            $this->title = $work->title;
            $this->client = $work->client;
            $this->meta = new MetaForm($work->meta);
            $this->skills = new SkillsForm($work);
            $this->_work = $work;
        } else {
            $this->meta = new MetaForm();
            $this->skills = new SkillsForm();
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['categoryId', 'title', 'date'], 'required'],
            [['title', 'link', 'client'], 'string', 'max' => '255'],
            ['status', 'integer'],
            ['date', 'date', 'format' => 'php:Y-m-d'],
            ['photo', 'image']
        ];
    }

    protected function internalForms(): array
    {
        return ['meta', 'skills'];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }
}