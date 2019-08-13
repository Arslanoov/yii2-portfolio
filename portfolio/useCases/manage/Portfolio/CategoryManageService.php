<?php

namespace portfolio\useCases\manage\Portfolio;

use portfolio\entities\Meta;
use portfolio\entities\Portfolio\Category;
use portfolio\forms\manage\Portfolio\CategoryForm;
use portfolio\repositories\Portfolio\CategoryRepository;
use portfolio\repositories\Portfolio\WorkRepository;
use DomainException;

class CategoryManageService
{
    private $categories;
    private $works;

    public function __construct(CategoryRepository $categories, WorkRepository $works)
    {
        $this->categories = $categories;
        $this->works = $works;
    }

    public function create(CategoryForm $form): Category
    {
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $this->categories->save($category);

        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);

        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $this->categories->save($category);
    }
    
    public function remove($id): void 
    {
        $category = $this->categories->get($id);
        if ($this->works->existsByCategory($category->id)) {
            throw new DomainException('Невозможно удалить категорию с работами');
        }
        $this->categories->delete($category);
    }
}