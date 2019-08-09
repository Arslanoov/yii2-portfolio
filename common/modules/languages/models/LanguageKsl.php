<?php

namespace common\modules\languages\models;

use Yii;

class LanguageKsl
{
    public static $list;

    public static function list_languages()
    {
        if (!self::$list){

            $languages = Yii::$app->getModule('languages')->languages;
            $list = '';

            array_walk($languages, function ($value) use (&$list){
                $list .= $value . '|';
            });

            self::$list = $list;
        }

        return self::$list;
    }

    public static function parsingUrl($language, $url_referrer){

        $list_languages = self::list_languages(); //список языков
        $host = Yii::$app->request->hostInfo;

        preg_match("#^($host)/($list_languages)(.*)#", $url_referrer, $match_arr);

        if (isset($match_arr[3]) && !empty($match_arr[3]) && !preg_match('#^\/#', $match_arr[3])){
            $separator = '/';
        } else {
            $separator = '';
        }


        $default_language = Yii::$app->getModule('languages')->default_language;
        $show_default = Yii::$app->getModule('languages')->show_default;

        if ($language == $default_language && !$show_default){
            $match_arr[2] = null;
        } else {
            $match_arr[2] = '/'.$language.$separator;
        }

        $url = $match_arr[1] . $match_arr[2] . $match_arr[3];
        return $url;
    }
}