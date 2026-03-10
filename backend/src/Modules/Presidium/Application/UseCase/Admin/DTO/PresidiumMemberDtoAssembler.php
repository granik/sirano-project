<?php


namespace App\Modules\Presidium\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Presidium\Domain\Entity\PresidiumMember;
use App\Shared\Application\DTO\DtoAssembler;

final class PresidiumMemberDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new PresidiumMemberDto();
    }
    
    /**
     * @param PresidiumMemberDto $dto
     * @param PresidiumMember    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id          = $entity->getId();
        $dto->name        = $entity->getName();
        $dto->middlename  = $entity->getMiddlename();
        $dto->lastname    = $entity->getLastname();
        $dto->image       = $entity->getImage();
        $dto->imageFile   = (new File())->setFilePath($entity->getImage());
        $dto->description = $entity->getDescription();
        $dto->isActive    = $entity->isActive();
        $dto->number      = $entity->getNumber();
    }
}