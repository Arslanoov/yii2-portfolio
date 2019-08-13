<?php

namespace portfolio\tests\unit\entities\Portfolio\Category;

use portfolio\entities\Meta;
use portfolio\entities\Portfolio\Category;
use Codeception\Test\Unit;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $category = Category::create(
            $name = 'Name',
            $slug = 'slug',
            $title = 'title',
            $description = 'desc',
            $meta = new Meta('Title', 'Desc', 'Keywords')
        );

        $this->assertEquals($category->name, $name);
        $this->assertEquals($category->slug, $slug);
        $this->assertEquals($category->title, $title);
        $this->assertEquals($category->description, $description);
        $this->assertEquals($category->meta, $meta);
    }
}