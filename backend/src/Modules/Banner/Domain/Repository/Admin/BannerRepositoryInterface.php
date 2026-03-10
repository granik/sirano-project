<?php


namespace App\Modules\Banner\Domain\Repository\Admin;


use App\Modules\Banner\Domain\Entity\Banner;

interface BannerRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function store(Banner $entity);
    
    public function find($id);
    
    public function update(Banner $entity);
    
    public function delete($entity);
}