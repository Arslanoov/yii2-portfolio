<?php

namespace common\modules\languages\controllers;

use Yii;
use yii\web\Controller;
use common\modules\languages\models\LanguageKsl;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        $language = Yii::$app->request->get('lang');

        $url_referrer = Yii::$app->request->get('url');

        if(!$url_referrer) $url_referrer = Yii::$app->request->referrer;

        if (!$url_referrer) $url_referrer = Yii::$app->request->hostInfo . '/'. $language;

        $url = LanguageKsl::parsingUrl($language, $url_referrer);

        Yii::$app->response->redirect($url);
    }

}