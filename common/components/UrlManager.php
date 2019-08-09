<?php

namespace common\components;

use Yii;
use yii\web\UrlManager as BaseUrlManager;

class UrlManager extends BaseUrlManager
{
    public function createUrl($params)
    {
        $url = parent::createUrl($params);

        if (empty($params['lang'])) {
            $curentLang = Yii::$app->language;

            if ($url == '/') {
                return '/' . $curentLang;
            } else {
                return '/' . $curentLang . $url;
            }
        };

        return $url;
    }
}