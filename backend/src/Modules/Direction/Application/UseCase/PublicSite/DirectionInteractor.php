<?php

namespace App\Modules\Direction\Application\UseCase\PublicSite;

use App\Modules\Direction\Domain\Entity\Direction;
use App\Modules\Direction\Domain\Repository\DirectionRepositoryInterface;

final class DirectionInteractor
{
    const NUMBER_ON_MAIN_PAGE = 4;
    
    /**
     * @var DirectionRepositoryInterface
     */
    private $repository;
    
    /**
     * DirectionInteractor constructor.
     *
     * @param DirectionRepositoryInterface $repository
     */
    public function __construct(
        DirectionRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
    
    public function activeList()
    {
        return $this->repository->activeList();
    }
    
    public function mainPage()
    {
        return $this->repository->mainPageList(self::NUMBER_ON_MAIN_PAGE);
    }
    
    public function find($id): ?Direction
    {
        return $this->repository->find($id);
    }
}
