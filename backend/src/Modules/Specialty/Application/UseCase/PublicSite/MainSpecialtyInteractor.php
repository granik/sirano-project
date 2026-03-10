<?php


namespace App\Modules\Specialty\Application\UseCase\PublicSite;


use App\Modules\Specialty\Domain\Repository\MainSpecialtyRepositoryInterface;

final class MainSpecialtyInteractor
{
    /**
     * @var MainSpecialtyRepositoryInterface
     */
    private $repository;
    
    /**
     * MainSpecialtyInteractor constructor.
     *
     * @param MainSpecialtyRepositoryInterface $repository
     */
    public function __construct(MainSpecialtyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list()
    {
        return $this->repository->customerFormlist();
    }
}