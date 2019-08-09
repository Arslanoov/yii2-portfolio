<?php

namespace frontend\controllers\portfolio;

use blog\readModels\LanguageReadRepository;
use blog\readModels\Portfolio\CategoryReadRepository;
use blog\readModels\Portfolio\SkillReadRepository;
use blog\readModels\Portfolio\WorkReadRepository;
use blog\readModels\Portfolio\WorksDataReadRepository;
use blog\useCases\Portfolio\WorkDataService;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class WorkController extends Controller
{
    public $layout = 'portfolio';

    private $works;
    private $categories;
    private $skills;
    private $worksDataService;

    public function __construct(
        string $id,
        Module $module,
        WorkReadRepository $works,
        CategoryReadRepository $categories,
        SkillReadRepository $skills,
        WorkDataService $worksDataService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->works = $works;
        $this->categories = $categories;
        $this->skills = $skills;
        $this->worksDataService = $worksDataService;
    }

    public function actionIndex()
    {
        $dataProvider = $this->works->getAll();

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSingle($id, $slug)
    {
        if (!$work = $this->works->find($id)) {
            throw new NotFoundHttpException('Публикация не найдена');
        }

        if (!$this->works->findBySlug($slug) || $work->slug != $slug) {
            return $this->redirect(['single', 'id' => $id, 'slug' => $work->slug]);
        }

        $this->layout = 'portfolio-single';

        $data = $this->worksDataService->getContentByLanguage($work->id, Yii::$app->language);

        return $this->render('single', [
            'work' => $work,
            'data' => $data
        ]);
    }

    public function actionCategory($slug)
    {
        if (!$category = $this->categories->findBySlug($slug)) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        $dataProvider = $this->works->getAllByCategory($category);

        return $this->render('category', [
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    public function actionSkill($slug)
    {
        if (!$skill = $this->skills->findBySlug($slug)) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        $dataProvider = $this->works->getAllBySkill($skill);

        return $this->render('skill', [
            'dataProvider' => $dataProvider,
            'skill' => $skill
        ]);
    }
}