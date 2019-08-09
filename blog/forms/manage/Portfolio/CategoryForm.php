<?php

namespace blog\forms\manage\Portfolio;

use blog\entities\Portfolio\Category;
use blog\forms\CompositeForm;
use blog\forms\manage\MetaForm;
use blog\validators\SlugValidator;

/**
 * @property $meta \blog\forms\MetaForm
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;

    private $_category;

    public function __construct(Category $category = null, array $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'title'], 'string', 'max' => 255],
            ['description', 'trim'],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null],
        ];
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}