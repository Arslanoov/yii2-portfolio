<?php

namespace portfolio\helpers;

use portfolio\readModels\PageReadRepository;

/**
 * Class PageHelper
 * @package blog\helpers
 */
class PageHelper
{
    /** @var PageReadRepository */
    private $repository;

    /**
     * PageHelper constructor.
     * @param PageReadRepository $repository
     */
    public function __construct(PageReadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаение главных страниц
     * @return array
     */
    public function getMainPages(): array
    {
        return $this->repository->getMain();
    }

    /**
     * Получение детей страница
     * @param $page
     * @return array
     */
    public function getChildren($page): array
    {
        return $this->repository->getChildren($page);
    }
}