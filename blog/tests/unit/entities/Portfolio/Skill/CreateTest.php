<?php

namespace blog\tests\unit\entities\Portfolio\Skill\Test;

use blog\entities\Portfolio\Skill;
use Codeception\Test\Unit;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $skill = Skill::create(
            $name = 'Name',
            $slug = 'slug'
        );

        $this->assertEquals($skill->name, $name);
        $this->assertEquals($skill->slug, $slug);
    }
}