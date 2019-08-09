<?php

use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'sitemap', 'url' => ['site/index'], 'visible' => Yii::$app->user->can('manager') | Yii::$app->user->can('content-manager')],
                    ['label' => 'Пользователи', 'icon' => 'user', 'url' => ['user/index'], 'visible' => Yii::$app->user->can('admin')],
                    [
                        'label' => 'Портфолио',
                        'icon' => 'address-card',
                        'items' => [
                            ['label' => 'Работы', 'icon' => 'suitcase', 'url' => ['portfolio/work/index']],
                            ['label' => 'Категории', 'icon' => 'sort-alpha-desc ','url' => ['portfolio/category/index']],
                            ['label' => 'Умения', 'icon' => 'pie-chart', 'url' => ['portfolio/skill/index']]
                        ],
                        'visible' => Yii::$app->user->can('content-manager')
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'folder',
                        'items' => [
                            ['label' => 'Файлы', 'icon' => 'file-zip-o', 'url' => ['content/file/index'], 'visible' => Yii::$app->user->can('admin')],
                            ['label' => 'Страницы', 'icon' => 'sticky-note-o', 'url' => ['content/page/index']],
                        ],
                        'visible' => Yii::$app->user->can('content-manager')
                    ],
                    ['label' => 'Сообщения', 'icon' => 'envelope-o', 'url' => ['contact/message/index'], 'visible' => Yii::$app->user->can('manager')],
                    ['label' => 'Языки', 'icon' => 'globe', 'url' => ['language/index'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Меню разработчика', 'icon' => 'binoculars', 'url' => ['test/default/index'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Удалить кэш', 'icon' => 'trash', 'url' => ['cache/delete'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'На главную', 'icon' => 'sign-out', 'url' => 'http://meteo.dev']
                ],
            ]
        ) ?>

    </section>

</aside>
