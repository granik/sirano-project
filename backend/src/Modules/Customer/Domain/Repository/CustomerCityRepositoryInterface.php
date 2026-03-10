<?php


namespace App\Modules\Customer\Domain\Repository;

use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\Customer\Domain\Entity\CustomerCity;


interface CustomerCityRepositoryInterface
{
    public function find(int $cityId): ?CustomerCity;
    
    public function finByParams(string $country, string $name, string $fullName);
    
    public function store(CustomerCity $city);
    
    public function findByKladrId(string $kladrId);
}