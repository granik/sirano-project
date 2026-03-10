<?php


namespace App\Modules\Direction\Application\UseCase\PublicSite;


use App\Modules\Direction\Domain\Entity\Category;
use App\Modules\Direction\Domain\Repository\PublicSite\CategoryRepositoryInterface;

final class CategoryInteractor
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;
    
    /**
     * CategoryInteractor constructor.
     *
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function find($id): ?Category
    {
        return $this->repository->find($id);
    }
}