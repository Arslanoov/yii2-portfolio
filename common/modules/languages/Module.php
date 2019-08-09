<?php

namespace common\modules\languages;

use common\modules\languages\models\LanguageKsl;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;

class Module extends BaseModule implements BootstrapInterface
{
    public $controllerNamespace = 'common\modules\languages\controllers';
    public $languages;
    public $default_language;
    public $show_default;

    public function bootstrap($app)
    {
        if (YII_ENV == 'test') return;

        $url = $app->request->url;

        $list_languages = LanguageKsl::list_languages();

        preg_match("#^/($list_languages)(.*)#", $url, $match_arr);

        if (isset($match_arr[1]) && $match_arr[1] != '/' && $match_arr[1] != ''){

            if( !$this->show_default && $match_arr[1] == $this->default_language) {
                $url = $app->request->absoluteUrl;
                $lang = $this->default_language;
                $app->response->redirect(['languages/default/index', 'lang' => $lang, 'url' => $url]);
            }

            $app->language = $match_arr[1];
            $app->formatter->locale = $match_arr[1];
            $app->homeUrl = '/'.$match_arr[1];

        } elseif(!$this->show_default) {
            $lang = $this->default_language;

            $app->language = $lang;
            $app->formatter->locale = $lang;
        } else {
            $url = $app->request->absoluteUrl;

            $lang = $this->default_language;

            $app->response->redirect(['languages/default/index', 'lang' => $lang, 'url' => $url], 301);
        }
    }
}