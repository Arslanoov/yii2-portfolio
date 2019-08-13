<?php

namespace frontend\widgets;

use portfolio\readModels\Portfolio\CategoryReadRepository;
use yii\base\Widget;

class PortfolioCategoriesWidget extends Widget
{
    private $categories;

    public function __construct(CategoryReadRepository $categories, array $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

    public function run(): string
    {
        $categoriesList = $this->categories->findAll();
        return $this->render('portfolio/categories', [
            'categories' => $categoriesList
        ]);
    }
}