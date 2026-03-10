<?php


namespace App\Modules\Presidium\Domain\Repository\Admin;


use App\Modules\Presidium\Domain\Entity\PresidiumMember;

interface PresidiumMemberRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function store(PresidiumMember $entity);
    
    public function find($id);
    
    public function update(PresidiumMember $entity);
    
    public function delete($entity);
}