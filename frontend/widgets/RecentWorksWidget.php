<?php

namespace frontend\widgets;

use portfolio\readModels\Portfolio\WorkReadRepository;
use yii\base\Widget;

class RecentWorksWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(WorkReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        $works = $this->repository->getLast($this->limit);

        return $this->render('portfolio/latest/works', [
            'works' => $works
        ]);
    }
}