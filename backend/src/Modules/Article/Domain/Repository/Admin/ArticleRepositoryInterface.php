<?php


namespace App\Modules\Article\Domain\Repository\Admin;


use App\Modules\Article\Domain\Entity\Article;

interface ArticleRepositoryInterface
{
    public function list(int $page, int $perPage, array $criteria);
    
    public function store(Article $entity);
    
    public function update(Article $entity);
    
    public function find($id);
    
    public function listAll();
    
    public function findByIds(array $articleIds);
    
    public function delete($entity);
}