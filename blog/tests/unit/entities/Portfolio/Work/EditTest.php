<?php

namespace blog\tests\unit\Portfolio\Work;

use blog\entities\Portfolio\Work\Work;
use blog\entities\Meta;
use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $work = Work::create(
            $categoryId = 2,
            $date = '29.05.2019',
            $link = 'link',
            $slug = 'slug',
            $title = 'title',
            $client = 'client',
            $content = 'content',
            $meta = new Meta('Title', 'Desc', 'Keywords')
        );

        $work->edit(
            $newCategoryId = 4,
            $newDate = '30.05.2019',
            $newLink = 'newLink',
            $newSlug = 'newslug',
            $newTitle = 'newTitle',
            $newClient = 'newClient',
            $newContent = 'newContent',
            $newMeta = new Meta('newTitle', 'newDesc', 'newKeywords')
        );

        $this->assertEquals($work->category_id, $newCategoryId);
        $this->assertEquals($work->date, $newDate);
        $this->assertEquals($work->link, $newLink);
        $this->assertEquals($work->slug, $newSlug);
        $this->assertEquals($work->title, $newTitle);
        $this->assertEquals($work->client, $newClient);
        $this->assertEquals($work->content, $newContent);
        $this->assertEquals($work->meta, $newMeta);
    }
}