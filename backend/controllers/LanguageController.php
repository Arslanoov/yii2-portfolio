<?php

namespace backend\controllers;

use backend\forms\LanguageSearch;
use portfolio\entities\Language;
use portfolio\forms\manage\LanguageForm;
use yii\web\Controller;
use yii\base\Module;
use portfolio\useCases\manage\LanguageManageService;
use Yii;
use DomainException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class LanguageController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, LanguageManageService $service, array $config = [])
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
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new LanguageSearch();
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
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $form = new LanguageForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $lang = $this->service->create($form);
                Yii::$app->session->setFlash('success', 'Язык успешно создан');
                return $this->redirect(['view', 'id' => $lang->id]);
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
        $lang = $this->findModel($id);

        $form = new LanguageForm($lang);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($id, $form);
                Yii::$app->session->setFlash('success', 'Язык успешно обновлен');
                return $this->redirect(['view', 'id' => $lang->id]);
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
            $this->service->remove($id);
        } catch (DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    private function findModel($id): Language
    {
        if (!($user = Language::findOne($id))) {
            throw new NotFoundHttpException('Язык не найден');
        }

        return $user;
    }
}