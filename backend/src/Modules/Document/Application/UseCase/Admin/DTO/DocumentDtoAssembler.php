<?php


namespace App\Modules\Document\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Document\Domain\Entity\Document;
use App\Shared\Application\DTO\DtoAssembler;

final class DocumentDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new DocumentDto();
    }
    
    /**
     * @param DocumentDto $dto
     * @param Document    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id       = $entity->getId();
        $dto->name     = $entity->getName();
        $dto->isActive = $entity->isActive();
        $dto->file     = $entity->getFile();
        $dto->fileFile = (new File())->setFilePath($entity->getFile());
    }
}