<?php


namespace App\Modules\Conference\Application\UseCase\Admin\DTO;


use App\Modules\Conference\Domain\Entity\ConferenceSeries;
use App\Shared\Application\DTO\DtoAssembler;

final class ConferenceSeriesDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ConferenceSeriesDto();
    }
    
    /**
     * @param ConferenceSeriesDto $dto
     * @param ConferenceSeries    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id        = $entity->getId();
        $dto->name      = $entity->getName();
        $dto->direction = $entity->getDirection()->getId();
    }
}