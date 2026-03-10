<?php


namespace App\Modules\Conference\Domain\Repository\PublicSite;

use App\Modules\Conference\Domain\Entity\Conference;


interface ConferenceSeriesRepositoryInterface
{
    public function list(int $limit, $direction);
}