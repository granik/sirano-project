<?php

namespace App\Modules\LearningModule\Domain\Repository\Admin;


use App\Modules\LearningModule\Domain\Entity\ModuleTest;

interface ModuleTestRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function store(ModuleTest $entity);
    
    public function find($id);
    
    public function update(ModuleTest $entity);
}