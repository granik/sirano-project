<?php


namespace App\Modules\Banner\Application\UseCase\PublicSite;


use App\Modules\Banner\Domain\Repository\PublicSite\BannerRepositoryInterface;

final class BannerInteractor
{
    /**
     * @var BannerRepositoryInterface
     */
    private $repository;
    
    /**
     * BannerInteractor constructor.
     *
     * @param BannerRepositoryInterface $repository
     */
    public function __construct(BannerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list()
    {
        return $this->repository->list();
    }
}