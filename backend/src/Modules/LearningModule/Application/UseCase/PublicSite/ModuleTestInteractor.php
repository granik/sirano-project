<?php

namespace App\Modules\LearningModule\Application\UseCase\PublicSite;


use App\Modules\Customer\Application\UseCase\Admin\CustomerInteractor;
use App\Modules\LearningModule\Domain\Repository\PublicSite\ModuleTestRepositoryInterface;
use App\Modules\LearningModule\Domain\Repository\PublicSite\ModuleTestResultRepositoryInterface;
use App\Modules\LearningModule\Domain\Entity\ModuleTest;
use App\Modules\LearningModule\Domain\Entity\ModuleTestResult;
use App\Shared\Domain\Exception\TestResultAlreadyExists;
use App\Modules\Identity\Repository\User;

final class ModuleTestInteractor
{
    /**
     * @var ModuleTestRepositoryInterface
     */
    private $repository;
    /**
     * @var CustomerInteractor
     */
    private $customerInteractor;
    /**
     * @var ModuleTestResultRepositoryInterface
     */
    private $resultRepository;
    
    /**
     * ModuleTestInteractor constructor.
     *
     * @param ModuleTestRepositoryInterface       $repository
     * @param ModuleTestResultRepositoryInterface $resultRepository
     * @param CustomerInteractor                  $customerInteractor
     */
    public function __construct(
        ModuleTestRepositoryInterface $repository,
        ModuleTestResultRepositoryInterface $resultRepository,
        CustomerInteractor $customerInteractor
    ) {
        $this->repository         = $repository;
        $this->customerInteractor = $customerInteractor;
        $this->resultRepository   = $resultRepository;
    }
    
    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * @param ModuleTest $moduleTest
     * @param int        $correctAnswerNumber
     * @param User       $user
     *
     * @throws Exceptions\UserIsNotCustomer
     * @throws TestResultAlreadyExists
     */
    public function checkTest(ModuleTest $moduleTest, int $correctAnswerNumber, User $user)
    {
        if ($this->isTested($moduleTest, $user)) {
            throw new TestResultAlreadyExists();
        }
        
        $customer = $this->customerInteractor->getCustomer($user);
        $module   = $moduleTest->getModule();
        $result   = ModuleTestResult::create($module, $customer, $correctAnswerNumber);
        
        $this->resultRepository->store($result);
    }
    
    public function isTested(ModuleTest $moduleTest, User $user)
    {
        $result = $this->resultRepository->findByModuleAndCustomer(
            $moduleTest->getModule(),
            $this->customerInteractor->getCustomer($user)
        );
        
        return $result instanceof ModuleTestResult;
    }
}