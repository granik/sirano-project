<?php

namespace App\Modules\Webinar\Domain\Repository\Admin;


use App\Modules\Webinar\Domain\Entity\Webinar;

interface WebinarRepositoryInterface
{
    public function list(int $page, int $perPage, array $criteria);
    
    public function find($id): ?Webinar;
    
    public function update(Webinar $webinar);
    
    public function store(Webinar $webinar);
    
    public function delete($entity);
}