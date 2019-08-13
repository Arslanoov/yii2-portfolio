<?php

namespace frontend\controllers;

use portfolio\readModels\Portfolio\WorkReadRepository;
use yii\base\Module;
use yii\web\Controller;
use Yii;

class SiteController extends Controller
{
    private $works;

    public function __construct(string $id, Module $module, WorkReadRepository $works, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->works = $works;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
