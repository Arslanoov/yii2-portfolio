<?php

namespace backend\controllers\contact;

use backend\forms\Contact\MessageSearch;
use portfolio\entities\Contact\Message;
use portfolio\useCases\manage\Contact\MessageManageService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use DomainException;
use yii\web\NotFoundHttpException;

class MessageController extends Controller
{
    private $service;

    public function __construct($id, $module, MessageManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
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
                        'roles' => ['manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
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

    private function findModel($id): Message
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Сообщение не найдено');
    }
}