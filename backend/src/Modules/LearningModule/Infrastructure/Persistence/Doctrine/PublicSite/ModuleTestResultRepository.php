<?php


namespace App\Modules\LearningModule\Infrastructure\Persistence\Doctrine\PublicSite;


use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\LearningModule\Domain\Repository\PublicSite\ModuleTestResultRepositoryInterface;
use App\Modules\LearningModule\Domain\Entity\Module;
use App\Modules\LearningModule\Domain\Entity\ModuleTestResult;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ModuleTestResultRepository implements ModuleTestResultRepositoryInterface
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
        $this->objectRepository = $this->entityManager->getRepository(ModuleTestResult::class);
    }
    
    public function findByModuleAndCustomer(Module $module, Customer $customer)
    {
        return $this->objectRepository->findOneBy(['module' => $module, 'customer' => $customer]);
    }
    
    public function store(ModuleTestResult $result)
    {
        $this->entityManager->persist($result);
        $this->entityManager->flush();
    }
}