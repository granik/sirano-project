<?php

namespace App\Modules\Customer\Domain\Repository\Admin;


use App\Modules\Customer\Domain\Entity\Customer;

interface CustomerRepositoryInterface
{
    public function findByEmail($email);

    public function find($id);

    public function store(Customer $customer): Customer;

    public function list(int $page, int $perPage, array $criteria);
    
    public function update(Customer $customer);
    
    public function delete($entity);
    
    public function listAll(array $criteria = []);
    
    public function total(array $criteria);
}