<?php


namespace App\Modules\Customer\Application\UseCase\Admin;


use App\Modules\Customer\Application\UseCase\Admin\DTO\CustomerCityDto;

interface CityParserInterface
{
    public function getCityData(string $query): ?CustomerCityDto;
}