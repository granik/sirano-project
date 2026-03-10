<?php


namespace App\Modules\Document\Domain\Repository\PublicSite;

use App\Modules\Document\Domain\Entity\Document;


interface DocumentRepositoryInterface
{
    public function list(int $page, int $perPage);
}