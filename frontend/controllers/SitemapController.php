<?php

namespace frontend\controllers;

use blog\entities\Portfolio\Category as PortfolioCategory;
use blog\entities\Portfolio\Work\Work;
use blog\readModels\Portfolio\CategoryReadRepository as PortfolioCategoryReadRepository;
use blog\readModels\Portfolio\WorkReadRepository;
use blog\entities\Blog\Category as BlogCategory;
use blog\entities\Blog\Post\Post;
use blog\readModels\Blog\CategoryReadRepository as BlogCategoryReadRepository;
use blog\readModels\Blog\PostReadRepository;
use blog\entities\Page;
use blog\readModels\PageReadRepository;
use blog\services\sitemap\IndexItem;
use blog\services\sitemap\MapItem;
use blog\services\sitemap\Sitemap;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class SitemapController extends Controller
{
    const ITEMS_PER_PAGE = 100;

    private $sitemap;
    private $pages;
    private $portfolioCategories;
    private $works;

    public function __construct(
        $id,
        $module,
        Sitemap $sitemap,
        PageReadRepository $pages,
        PortfolioCategoryReadRepository $portfolioCategories,
        WorkReadRepository $works,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->sitemap = $sitemap;
        $this->pages = $pages;
        $this->portfolioCategories = $portfolioCategories;
        $this->works = $works;
    }

    public function actionIndex(): Response
    {
        return $this->renderSitemap('sitemap-index', function () {
            return $this->sitemap->generateIndex([
                new IndexItem(Url::to(['pages'], true)),
                new IndexItem(Url::to(['portfolio-categories'], true)),
                new IndexItem(Url::to(['portfolio-works-index'], true)),
            ]);
        });
    }

    public function actionPages(): Response
    {
        return $this->renderSitemap('sitemap-pages', function () {
            return $this->sitemap->generateMap(array_map(function (Page $page) {
                return new MapItem(
                    Url::to(['/page/view', 'id' => $page->id], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->pages->getAll()));
        });
    }

    public function actionPortfolioCategories(): Response
    {
        return $this->renderSitemap('sitemap-portfolio-categories', function () {
            return $this->sitemap->generateMap(array_map(function (PortfolioCategory $category) {
                return new MapItem(
                    Url::to(['/portfolio/work/category', 'slug' => $category->slug], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->portfolioCategories->findAll()));
        });
    }

    public function actionPortfolioWorksIndex(): Response
    {
        return $this->renderSitemap('sitemap-portfolio-works-index', function () {
            return $this->sitemap->generateIndex(array_map(function ($start) {
                return new IndexItem(Url::to(['portfolio-works', 'start' => $start * self::ITEMS_PER_PAGE], true));
            }, range(0, (int)($this->works->count() / self::ITEMS_PER_PAGE))));
        });
    }

    public function actionPortfolioWorks($start = 0): Response
    {
        return $this->renderSitemap(['sitemap-portfolio-works', $start], function () use ($start) {
            return $this->sitemap->generateMap(array_map(function (Work $work) {
                return new MapItem(
                    Url::to(['/portfolio/work/single', 'id' => $work->id, 'slug' => $work->slug], true),
                    null,
                    MapItem::DAILY
                );
            }, $this->works->getAllByRange($start, self::ITEMS_PER_PAGE)));
        });
    }

    private function renderSitemap($key, callable $callback): Response
    {
        return Yii::$app->response->sendContentAsFile(Yii::$app->cache->getOrSet($key, $callback), Url::canonical(), [
            'mimeType' => 'application/xml',
            'inline' => true
        ]);
    }
}