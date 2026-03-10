<?php


namespace App\Modules\Banner\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Banner\Domain\Entity\Banner;
use App\Shared\Application\DTO\DtoAssembler;

final class BannerDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new BannerDto();
    }
    
    /**
     * @param BannerDto $dto
     * @param Banner    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id               = $entity->getId();
        $dto->name             = $entity->getName();
        $dto->link             = $entity->getLink();
        $dto->number           = $entity->getNumber();
        $dto->desktopImage     = $entity->getDesktopImage();
        $dto->desktopImageFile = (new File())->setFilePath($entity->getDesktopImage());
        $dto->mobileImage      = $entity->getMobileImage();
        $dto->mobileImageFile  = (new File())->setFilePath($entity->getMobileImage());
        $dto->isActive         = $entity->isActive();
        $dto->backgroundColor  = $entity->getBackgroundColor();
    }
}