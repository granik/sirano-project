<?php


namespace App\Modules\Document\Domain\Repository\Admin;


use App\Modules\Document\Domain\Entity\Document;

interface DocumentRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function store(Document $entity);
    
    public function update(Document $entity);
    
    public function find($id);
    
    public function delete($entity);
}