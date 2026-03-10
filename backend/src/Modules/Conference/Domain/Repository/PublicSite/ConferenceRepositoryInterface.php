<?php

namespace App\Modules\Conference\Domain\Repository\PublicSite;

use App\Modules\Conference\Domain\Entity\Conference;


use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\Direction\Domain\Entity\Direction;
use DateTime;

interface ConferenceRepositoryInterface
{
    public function list(int $page, int $perPage, DateTime $tillDate, $direction);
    
    public function archive(int $page, int $perPage, ?DateTime $tillDate, $direction);
    
    public function find($id);
    
    public function dashboard(Customer $customer);
    
    public function getProfileConferences(Customer $customer, int $page, int $perPage, DateTime $tillDate);
    
    public function getCustomerScore(Customer $customer);
    
    public function listComingSoon(int $limit, ?Direction $direction);
    
    public function getMaxScore();
}