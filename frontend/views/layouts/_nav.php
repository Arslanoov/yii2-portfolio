<?php

/** @var $this yii\web\View */
/** @var $pageHelper \blog\helpers\PageHelper */

use yii\widgets\Menu;
use common\modules\languages\widgets\ListWidget;
use yii\helpers\Url;

?>

<div id="nav-wrapper">
    <!-- start main nav -->
    <nav id="main-nav">
        <!-- start main nav -->
        <nav id="main-nav">

            <?php $menu = [
                'encodeLabels' => false,
                'options' => [
                    'class' => 'clearfix'
                ],
                'submenuTemplate' => '<ul class="sub-nav hidden">{items}</ul>'
            ];

            $menu['items'][] = ['label' => Yii::t('app', 'Portfolio'), 'url' => [Yii::$app->language . '/portfolio'], 'options' => ['class' => (Url::current() ==  '/' ? 'selected' : '')]];
            $menu['items'][] = ['label' => Yii::t('app', 'Contact'), 'url' => [Yii::$app->language . '/contact'], 'options' => ['class' => (Url::current() ==  '/contact' ? 'selected' : '')]];

            $pages = $pageHelper->getMainPages();
            foreach ($pages as $page) {
                $item = [
                    'label' => $page->title . (($pageHelper->getChildren($page)) ? '<i class="fa fa-angle-down"></i>': ''),
                    'url' => ['/page/view', 'id' => $page->id],
                ];

                if ($page->depth > 0) {
                    $item['template'] = '<a href="{url}" class="sub-nav-toggle">{label}</a>';
                    $children = $pageHelper->getChildren($page);

                    foreach ($children as $child) {
                        $item['items'][] = ['label' => $child->title, 'url' => ['/page/view', 'id' => $child->id]];
                    }
                }

                $menu['items'][] = $item;
            }

            $menu['items'][] = ['label' => Yii::t('app', 'Manage'), 'url' => 'http://admin.meteo.dev', 'visible' => Yii::$app->user->can('manager') || Yii::$app->user->can('content-manager')];
            $menu['items'][] = ['label' => Yii::t('app', 'Logout'), 'url' => [Yii::$app->language . '/user/logout'], 'options' => ['class' => (Url::current() ==  '/user/logout' ? 'selected' : '')], 'visible' => !Yii::$app->user->isGuest];

            ?>

            <?= Menu::widget($menu); ?>

            <?= ListWidget::widget(); ?>

        </nav>
        <!-- end main nav -->
    </nav>
    <!-- end main nav -->
</div>