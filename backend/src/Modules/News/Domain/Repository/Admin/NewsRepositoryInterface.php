<?php


namespace App\Modules\News\Domain\Repository\Admin;


use App\Modules\News\Domain\Entity\News;

interface NewsRepositoryInterface
{
    public function list(int $page, int $perPage, array $criteria);
    
    public function store(News $entity);
    
    public function find($id);
    
    public function update(News $entity);
    
    public function delete($entity);
}