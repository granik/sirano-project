<?php

namespace App\Modules\Webinar\Domain\Repository\PublicSite;


use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\Webinar\Domain\Entity\Webinar;
use DateTime;

interface WebinarRepositoryInterface
{
    public function listAll();

    public function find($id);

    public function archive(int $page, int $perPage, ?DateTime $fromDate, $direction);

    public function update(Webinar $webinar);

    public function store(Webinar $webinar);

    public function list(int $page, int $perPage, DateTime $tillDate, $direction);
    
    public function dashboard(Customer $customer);
    
    public function getProfileWebinars(Customer $customer, int $page, int $perPage, DateTime $tillDate);
    
    public function randomArchive(Webinar $webinar);
    
    public function getCustomerScore(Customer $customer);
    
    public function getMaxScore();
    
    public function getInADayWebinars(DateTime $dateTime);
}