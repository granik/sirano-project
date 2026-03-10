<?php

namespace App\Modules\Conference\Domain\Repository\Admin;


use App\Modules\Conference\Domain\Entity\Conference;

interface ConferenceRepositoryInterface
{
    public function list(int $page, int $perPage, array $criteria);
    
    public function store(Conference $conference);
    
    public function find($id);
    
    public function update(Conference $conference);
    
    public function delete($entity);
}