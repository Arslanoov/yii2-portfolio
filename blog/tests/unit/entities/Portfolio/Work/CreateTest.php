<?php

namespace blog\tests\unit\entities\Portfolio\Work;

use blog\entities\Meta;
use blog\entities\Portfolio\Work\Work;
use Codeception\Test\Unit;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $work = Work::create(
            $categoryId = 5,
            $date = '25.05.2019',
            $link = 'link',
            $slug = 'slug',
            $title = 'title',
            $client = 'client',
            $content = 'content',
            $meta = new Meta('Title', 'Desc', 'Keywords')
        );

        $this->assertEquals($work->category_id, $categoryId);
        $this->assertEquals($work->date, $date);
        $this->assertEquals($work->link, $link);
        $this->assertEquals($work->slug, $slug);
        $this->assertEquals($work->title, $title);
        $this->assertEquals($work->client, $client);
        $this->assertEquals($work->content, $content);
        $this->assertEquals($work->meta, $meta);
    }
}