<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class FooterAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/jquery-easing-1.3.js',
        'js/jquery.touchSwipe.min.js',
        'js/jquery.isotope2.min.js',
        'js/jquery.ba-bbq.min.js',
        'js/packery-mode.pkgd.min.js',
        'js/jquery.isotope.load.js',
        'js/main.js',
        'js/jquery.form.js',
        'js/input.fields.js',
        'js/preloader.js',
        'js/jquery.fancybox.pack.js',
        'js/jquery.flexslider-min.js'
    ];
}