<?php


namespace App\Modules\Specialty\Application\UseCase\PublicSite;


use App\Modules\Specialty\Domain\Repository\AdditionalSpecialtyRepositoryInterface;

final class AdditionalSpecialtyInteractor
{
    /**
     * @var AdditionalSpecialtyRepositoryInterface
     */
    private $repository;
    
    /**
     * AdditionalSpecialtyInteractor constructor.
     *
     * @param AdditionalSpecialtyRepositoryInterface $repository
     */
    public function __construct(AdditionalSpecialtyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list()
    {
        return $this->repository->customerFormlist();
    }
}