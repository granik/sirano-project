<?php


namespace App\Modules\Specialty\Application\UseCase\Admin\DTO;


use App\Modules\Specialty\Domain\Entity\AdditionalSpecialty;
use App\Modules\Specialty\Domain\Entity\MainSpecialty;
use App\Shared\Application\DTO\DtoAssembler;

final class SpecialtyDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new SpecialtyDto();
    }
    
    /**
     * @param SpecialtyDto                      $dto
     * @param MainSpecialty|AdditionalSpecialty $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id   = $entity->getId();
        $dto->name = $entity->getName();
        
        if ($entity instanceof MainSpecialty) {
            $dto->isResearcher = $entity->isResearcher();
        }
    }
}