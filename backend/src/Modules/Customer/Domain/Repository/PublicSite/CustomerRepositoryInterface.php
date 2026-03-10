<?php


namespace App\Modules\Customer\Domain\Repository\PublicSite;

use App\Modules\Customer\Domain\Entity\Customer;


interface CustomerRepositoryInterface
{
    public function list(int $page, int $perPage, ?string $query);
}