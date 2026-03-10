<?php


namespace App\Modules\LearningModule\Domain\Repository\PublicSite;


use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\LearningModule\Domain\Entity\Module;
use App\Modules\LearningModule\Domain\Entity\ModuleTestResult;

interface ModuleTestResultRepositoryInterface
{
    public function findByModuleAndCustomer(Module $module, Customer $customer);
    
    public function store(ModuleTestResult $result);
}