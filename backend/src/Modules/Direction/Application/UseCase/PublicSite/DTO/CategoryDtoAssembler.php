<?php


namespace App\Modules\Direction\Application\UseCase\PublicSite\DTO;


use App\Modules\Direction\Domain\Entity\Category;
use App\Shared\Application\DTO\DtoAssembler;

final class CategoryDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new CategoryDto();
    }
    
    /**
     * @param CategoryDto $dto
     * @param Category    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id   = $entity->getId();
        $dto->name = $entity->getName();
    }
}