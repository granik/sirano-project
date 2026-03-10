<?php


namespace App\Modules\AdvertBanner\Application\UseCase\PublicSite;


use App\Modules\AdvertBanner\Domain\Repository\PublicSite\AdvertBannerRepositoryInterface;

final class AdvertBannerInteractor
{
    /**
     * @var AdvertBannerRepositoryInterface
     */
    private $repository;
    
    /**
     * AdvertBannerInteractor constructor.
     *
     * @param AdvertBannerRepositoryInterface $repository
     */
    public function __construct(AdvertBannerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list()
    {
        return $this->repository->list();
    }
}