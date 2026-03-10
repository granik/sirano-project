<?php


namespace App\Modules\Direction\Domain\Repository\PublicSite;

use App\Modules\Direction\Domain\Entity\Direction;


use App\Modules\Direction\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function find($id): ?Category;
}