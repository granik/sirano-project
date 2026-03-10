<?php


namespace App\Modules\Direction\Domain\Repository\Admin;


use App\Modules\Direction\Domain\Entity\Category;
use App\Modules\Direction\Domain\Entity\Direction;

interface CategoryRepositoryInterface
{
    public function deleteByIds(array $deleteIds);
    
    public function store(Category $category);
    
    public function update(Category $category);
    
    public function find($id);
    
    public function listCategoryByDirection(Direction $entity);
}