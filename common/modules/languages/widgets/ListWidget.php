<?php

namespace common\modules\languages\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class ListWidget extends Widget
{
    public $array_languages;

    public function init()
    {
        $language = Yii::$app->language;

        $array_lang = [];
        foreach (Yii::$app->getModule('languages')->languages as $key => $value) {
            $array_lang += [$value => Html::a(' - ' .$key, ['languages/default/index', 'lang' => $value])];
        }

        if (isset($array_lang[$language])) unset($array_lang[$language]);
        $this->array_languages = $array_lang;
    }

    public function run()
    {
        return $this->render('list',[
            'array_lang' => $this->array_languages
        ]);
    }

}