<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/reset.css',
        'css/font-awesome.min.css',
        'css/contact.css',
        'css/styles.css',
        'css/jquery.fancybox.css',
        'css/responsive.css',
        'css/flexslider.css',
        'https://fonts.googleapis.com/css?family=Amiri:400,600',
        'https://fonts.googleapis.com/css?family=Oswald:400,600,700',
        'https://fonts.googleapis.com/css?family=Lato:400,600'
    ];
    public $js = [
        'js/modernizr.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'frontend\assets\FooterAsset'
    ];
}
