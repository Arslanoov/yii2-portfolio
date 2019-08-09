<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class GoogleMapAsset extends AssetBundle
{
    public $js = [
        'js/googlemaps.js'
    ];
    public $jsOptions = [
        'position' => View::POS_READY
    ];
}