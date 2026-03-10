<?php


namespace App\Modules\AdvertBanner\Domain\Repository\Admin;


use App\Modules\AdvertBanner\Domain\Entity\AdvertBanner;

interface AdvertBannerRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function store(AdvertBanner $entity);
    
    public function find($id);
    
    public function update(AdvertBanner $entity);
    
    public function delete($entity);
}