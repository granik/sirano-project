<?php


namespace App\Modules\AdvertBanner\Infrastructure\Persistence\Doctrine\PublicSite;


use App\Modules\AdvertBanner\Domain\Entity\AdvertBanner;
use App\Modules\AdvertBanner\Domain\Repository\PublicSite\AdvertBannerRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class AdvertBannerRepository implements AdvertBannerRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var ObjectRepository
     */
    private $objectRepository;
    
    /**
     * @var ObjectRepository
     */
    private $slideRepository;
    
    /**
     * @var ObjectRepository
     */
    private $articleRepository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager    = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(AdvertBanner::class);
    }
    
    public function list()
    {
        return $this->objectRepository->findBy(['isActive' => true], ['number' => 'asc']);
    }
}