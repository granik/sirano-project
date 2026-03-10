<?php


namespace App\Modules\Banner\Domain\Repository\PublicSite;

use App\Modules\Banner\Domain\Entity\Banner;


interface BannerRepositoryInterface
{
    public function list();
}