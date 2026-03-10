<?php

namespace App\Modules\LearningModule\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\LearningModule\Domain\Entity\ModuleSlide;
use App\Shared\Application\DTO\DtoAssembler;

final class ModuleSlideDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ModuleSlideDto();
    }
    
    /**
     * @param ModuleSlideDto $dto
     * @param ModuleSlide    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id        = $entity->getId();
        $dto->name      = $entity->getName();
        $dto->number    = $entity->getNumber();
        $dto->image     = $entity->getImage();
        $dto->imageFile = (new File())->setFilePath($entity->getImage());
    }
}