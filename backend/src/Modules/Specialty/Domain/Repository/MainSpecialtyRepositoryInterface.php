<?php


namespace App\Modules\Specialty\Domain\Repository;

use App\Modules\Specialty\Domain\Entity\MainSpecialty;


interface MainSpecialtyRepositoryInterface
{
    public function list(int $page, int $perPage, array $criteria);
    
    public function store(MainSpecialty $entity);
    
    public function find($id);
    
    public function findByName($name);
    
    public function update(MainSpecialty $entity);
    
    public function delete($entity);
    
    public function customerFormlist();
}