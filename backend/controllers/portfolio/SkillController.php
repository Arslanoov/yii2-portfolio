<?php

namespace backend\controllers\portfolio;

use backend\forms\Portfolio\SkillSearch;
use blog\entities\Portfolio\Skill;
use blog\forms\manage\Portfolio\SkillForm;
use blog\useCases\manage\Portfolio\SkillManageService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use DomainException;

class SkillController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, SkillManageService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST']
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
        $searchModel = new SkillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $form = new SkillForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $skill = $this->service->create($form);
                return $this->redirect(['view', 'id' => $skill->id]);
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
        $skill = $this->findModel($id);

        $form = new SkillForm($skill);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($skill->id, $form);
                return $this->redirect(['view', 'id' => $skill->id]);
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
            $this->service->delete($id);
        } catch (DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    private function findModel($id): Skill
    {
        if (!$skill = Skill::findOne($id)) {
            throw new NotFoundHttpException('Умение не найдено');
        }

        return $skill;
    }
}