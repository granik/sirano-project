<?php

namespace App\Modules\Conference\Domain\Repository;

use App\Modules\Conference\Domain\Entity\Conference;
use App\Modules\Conference\Domain\Entity\ConferenceSubscriber;


use App\Modules\Customer\Domain\Entity\Customer;

interface ConferenceSubscriberRepositoryInterface
{
    public function store(ConferenceSubscriber $subscriber);
    
    public function findByConferenceAndCustomer(Conference $conference, Customer $customer);
    
    public function delete(ConferenceSubscriber $subscriber);
    
    public function updateVisits(Conference $conference, array $customerIds);
    
    public function update(ConferenceSubscriber $subscriber);
}