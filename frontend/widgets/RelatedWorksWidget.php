<?php

namespace frontend\widgets;

use blog\readModels\Portfolio\WorkReadRepository;
use yii\base\Widget;

class RelatedWorksWidget extends Widget
{
    public $workId;
    public $categoryId;
    public $limit = 2;

    private $repository;

    public function __construct(WorkReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        $relatedWorksList = $this->repository->getRelatedWorks($this->workId, $this->categoryId, $this->limit);

        return $this->render('portfolio/related/works', [
            'relatedWorksList' => $relatedWorksList
        ]);
    }
}