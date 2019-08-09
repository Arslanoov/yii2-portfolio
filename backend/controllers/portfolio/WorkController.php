<?php

namespace backend\controllers\portfolio;

use backend\forms\Portfolio\WorkSearch;
use blog\entities\Portfolio\Work\Work;
use blog\entities\Portfolio\Work\WorkData;
use blog\forms\manage\Portfolio\Work\WorkForm;
use blog\forms\manage\Portfolio\Work\WorkDataForm;
use blog\repositories\LanguageRepository;
use blog\repositories\NotFoundException;
use blog\repositories\Portfolio\WorkDataRepository;
use blog\repositories\Portfolio\WorkRepository;
use blog\useCases\manage\Portfolio\WorkManageService;
use blog\useCases\Portfolio\WorkDataService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use DomainException;
use Yii;
use yii\web\NotFoundHttpException;

class WorkController extends Controller
{
    private $workService;
    private $workDataService;
    private $works;
    private $languages;
    private $worksData;

    public function __construct(
        string $id,
        Module $module,
        WorkManageService $workService,
        WorkDataService $workDataService,
        WorkRepository $works,
        LanguageRepository $languages,
        WorkDataRepository $worksData,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->workService = $workService;
        $this->workDataService = $workDataService;
        $this->works = $works;
        $this->languages = $languages;
        $this->worksData = $worksData;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST']
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
        $searchModel = new WorkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $work = $this->findModel($id);

        return $this->render('view', [
            'work' => $work
        ]);
    }

    public function actionCreate()
    {
        $form = new WorkForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $work = $this->workService->create($form);
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

    public function actionCreateData($workId)
    {
        if (!($this->works->get($workId))) {
            throw new NotFoundException('Работа не найдена');
        }

        $form = new WorkDataForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->workDataService->create($form, $workId);
                return $this->redirect(['view', 'id' => $workId]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('createData', [
            'model' => $form,
            'workId' => $workId
        ]);
    }

    public function actionUpdate($id)
    {
        $work = $this->findModel($id);

        $form = new WorkForm($work);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->workService->edit($id, $form);
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

    public function actionUpdateData($workId, $dataId, $langId)
    {
        if (!($work = $this->works->get($workId))) {
            throw new NotFoundException('Работа не найдена');
        }

        if (!$this->worksData->getByWorkAndLang($workId, $langId)) {
            throw new NotFoundException('Описание работы с данным языком не найдено');
        }

        $data = $this->findData($dataId);

        $form = new WorkDataForm($data);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->workDataService->edit($form, $dataId);
                return $this->redirect(['view', 'id' => $workId]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('updateData', [
            'model' => $form,
            'workId' => $workId
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->workService->remove($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect('index');
    }

    public function actionActivate($id)
    {
        try {
            $this->workService->activate($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionDraft($id)
    {
        try {
            $this->workService->draft($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    private function findData($id): WorkData
    {
        if (($workData = WorkData::findOne($id)) === null) {
            throw new NotFoundException('Описание не найдено');
        }

        return $workData;
    }

    private function findModel($id): Work
    {
        if (($work = Work::findOne($id)) === null) {
            throw new NotFoundException('Работа не найдена');
        }
        return $work;
    }
}