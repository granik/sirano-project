<?php

namespace App\Modules\LearningModule\Application\UseCase\PublicSite;


use App\Modules\Customer\Application\UseCase\Admin\CustomerInteractor;
use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\LearningModule\Domain\Repository\PublicSite\ModuleRepositoryInterface;
use App\Modules\LearningModule\Domain\Entity\Module;
use App\Modules\LearningModule\Domain\Entity\ModuleTest;
use App\Modules\Identity\Repository\User;

final class ModuleInteractor
{
    /**
     * @var ModuleRepositoryInterface
     */
    private $repository;
    /**
     * @var ModuleTestInteractor
     */
    private $testInteractor;
    /**
     * @var CustomerInteractor
     */
    private $customerInteractor;
    
    /**
     * ModuleInteractor constructor.
     *
     * @param ModuleRepositoryInterface $repository
     * @param ModuleTestInteractor      $testInteractor
     * @param CustomerInteractor        $customerInteractor
     */
    public function __construct(
        ModuleRepositoryInterface $repository,
        ModuleTestInteractor $testInteractor,
        CustomerInteractor $customerInteractor
    ) {
        $this->repository         = $repository;
        $this->testInteractor     = $testInteractor;
        $this->customerInteractor = $customerInteractor;
    }
    
    public function list(int $page, int $perPage, $direction, $category)
    {
        return $this->repository->list($page, $perPage, $direction, $category);
    }
    
    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * @param Module $entity
     *
     * @return ModuleTest
     */
    public function getTest(Module $entity)
    {
        $test = $entity->getTest();
        
        if ($test instanceof ModuleTest) {
            $test = $this->testInteractor->find($test->getId());
        }
        
        return $test;
    }
    
    public function getDashboardModules($user)
    {
        $customer = $this->customerInteractor->getCustomer($user);
        
        return $this->repository->dashboard($customer);
        
    }
    
    public function getProfileModules(User $user, int $page, int $perPage)
    {
        $customer = $this->customerInteractor->getCustomer($user);
    
        return $this->repository->getProfileModules($customer, $page, $perPage);
    
    }
    
    public function getCustomerScore(Customer $customer)
    {
        return $this->repository->getCustomerScore($customer);
    }
    
    public function getMaxScore()
    {
        return $this->repository->getMaxScore();
    }
}