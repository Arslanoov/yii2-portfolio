<?php

namespace backend\controllers\portfolio;

use backend\forms\Portfolio\CategorySearch;
use blog\entities\Portfolio\Category;
use blog\entities\Portfolio\Work\Work;
use blog\forms\manage\Portfolio\CategoryForm;
use blog\forms\manage\Portfolio\Work\WorkForm;
use blog\repositories\NotFoundException;
use blog\useCases\manage\Portfolio\CategoryManageService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use DomainException;
use Yii;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(string $id, Module $module, CategoryManageService $categoryService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryService = $categoryService;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['content-manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $category = $this->findModel($id);

        return $this->render('view', [
            'category' => $category
        ]);
    }

    public function actionCreate()
    {
        $form = new CategoryForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $work = $this->categoryService->create($form);
                return $this->redirect(['view', 'id' => $work->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form
        ]);
    }

    public function actionUpdate($id)
    {
        $category = $this->findModel($id);

        $form = new CategoryForm($category);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->categoryService->edit($id, $form);
                return $this->redirect(['view', 'id' => $id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->categoryService->remove($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect('index');
    }

    private function findModel($id): Category
    {
        if (($category = Category::findOne($id)) === null) {
            throw new NotFoundException('Категория не найдена');
        }
        return $category;
    }
}