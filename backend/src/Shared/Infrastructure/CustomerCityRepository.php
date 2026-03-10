<?php


namespace App\Shared\Infrastructure;


use App\Modules\Customer\Domain\Entity\CustomerCity;
use App\Modules\Customer\Domain\Repository\CustomerCityRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class CustomerCityRepository implements CustomerCityRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var ObjectRepository
     */
    private $objectRepository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager    = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(CustomerCity::class);
    }
    
    public function find(int $cityId): ?CustomerCity
    {
        return $this->objectRepository->find($cityId);
    }
    
    public function finByParams(string $country, string $name, string $fullName)
    {
        return $this->objectRepository->findOneBy([
            'country'  => $country,
            'name'     => $name,
            'fullName' => $fullName,
        ]);
    }
    
    public function store(CustomerCity $city)
    {
        $this->entityManager->persist($city);
        $this->entityManager->flush();
    }
    
    public function findByKladrId(string $kladrId)
    {
        return $this->objectRepository->findOneBy(['kladrId' => $kladrId]);
    }
}