<?php

namespace App\Modules\Webinar\Domain\Repository;

use App\Modules\Webinar\Domain\Entity\Webinar;
use App\Modules\Webinar\Domain\Entity\WebinarSubscriber;


use App\Modules\Customer\Domain\Entity\Customer;

interface WebinarSubscriberRepositoryInterface
{
    public function store(WebinarSubscriber $subscriber);
    
    public function findByWebinarAndCustomer(Webinar $webinar, Customer $customer);
    
    public function delete(WebinarSubscriber $subscriber);
    
    public function update(WebinarSubscriber $subscriber);
}