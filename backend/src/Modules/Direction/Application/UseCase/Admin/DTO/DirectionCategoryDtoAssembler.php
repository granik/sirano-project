<?php


namespace App\Modules\Direction\Application\UseCase\Admin\DTO;


use App\Modules\Direction\Domain\Entity\Category;
use App\Shared\Application\DTO\DtoAssembler;

final class DirectionCategoryDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new DirectionCategoryDto();
    }
    
    /**
     * @param DirectionCategoryDto $dto
     * @param Category             $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id   = $entity->getId();
        $dto->name = $entity->getName();
    }
}