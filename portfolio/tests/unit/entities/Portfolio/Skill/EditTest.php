<?php

namespace portfolio\tests\unit\entities\Portfolio\Skill\Test;

use portfolio\entities\Portfolio\Skill;
use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $skill = Skill::create(
            $name = 'Name',
            $slug = 'slug'
        );

        $skill->edit(
            $newName = 'newName',
            $newSlug = 'newslug'
        );

        $this->assertEquals($skill->name, $newName);
        $this->assertEquals($skill->slug, $newSlug);
    }
}