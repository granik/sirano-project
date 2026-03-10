<?php

namespace App\Shared\Application\DTO;


use App\Modules\Location\Domain\Entity\City;
use App\Modules\Location\Application\UseCase\CityDto;

final class CityDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new CityDto();
    }
    
    /**
     * @param CityDto $dto
     * @param City    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id   = $entity->getId();
        $dto->name = $entity->getName();
    }
}