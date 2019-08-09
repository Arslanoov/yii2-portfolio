<?php

namespace frontend\widgets;

use blog\readModels\Portfolio\CategoryReadRepository;
use blog\readModels\Portfolio\SkillReadRepository;
use yii\base\Widget;

class PortfolioSkillsWidget extends Widget
{
    private $skills;

    public function __construct(SkillReadRepository $skills, array $config = [])
    {
        parent::__construct($config);
        $this->skills = $skills;
    }

    public function run(): string
    {
        $skillsList = $this->skills->findAll();
        
        return $this->render('portfolio/skills', [
            'skillsList' => $skillsList
        ]);
    }
}