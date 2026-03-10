<?php

namespace App\Modules\LearningModule\Domain\Repository\PublicSite;


use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\LearningModule\Domain\Entity\Module;

interface ModuleRepositoryInterface
{
    public function list(int $page, int $perPage, $direction, $category);
    
    public function find($id): ?Module;
    
    public function dashboard(Customer $customer);
    
    public function getProfileModules(Customer $customer, int $page, int $perPage);
    
    public function getCustomerScore(Customer $customer);
    
    public function getMaxScore();
}