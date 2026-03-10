<?php


namespace App\Modules\Presidium\Domain\Repository\PublicSite;


interface PresidiumMemberRepositoryInterface
{
    public function list(int $page, int $perPage);
}