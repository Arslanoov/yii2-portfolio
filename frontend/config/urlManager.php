<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'languages' => 'languages/default/index',

        '' => 'portfolio/work/index',
        'page-<page:\d+>' => 'site/index',

        'user/<_a:login|logout>' => 'auth/auth/<_a>',
        'user/signup' => 'auth/signup/request',
        'user/signup/confirm' => 'auth/signup/confirm',
        'user/reset/password' => 'auth/reset/request',
        'user/reset/password/confirm' => 'auth/reset/confirm',

        'portfolio' => 'portfolio/work/index',
        'portfolio/page-<page:\d+>' => 'portfolio/work/index',

        'portfolio/category/<slug:[\w\-]+>/page-<page:\d+>' => 'portfolio/work/category',
        'portfolio/category/<slug:[\w\-]+>' => 'portfolio/work/category',

        'portfolio/skill/<slug:[\w\-]+>/page-<page:\d+>' => 'portfolio/work/skill',
        'portfolio/skill/<slug:[\w\-]+>' => 'portfolio/work/skill',

        'portfolio/<id:\d+>-<slug:[\w\-]+>' => 'portfolio/work/single',

        ['pattern' => 'sitemap', 'route' => 'sitemap/index', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>-<start:\d+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],

        ['class' => 'frontend\urls\PageUrlRule'],

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];