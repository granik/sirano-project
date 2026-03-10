<?php


namespace App\Modules\Article\Application\UseCase\PublicSite;


use App\Modules\Article\Domain\Repository\PublicSite\ArticleRepositoryInterface;

final class ArticleInteractor
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $repository;
    
    /**
     * ArticleInteractor constructor.
     *
     * @param ArticleRepositoryInterface $repository
     */
    public function __construct(ArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list(int $page, int $perPage, $direction, $category)
    {
        return $this->repository->list($page, $perPage, $direction, $category);
    }
}