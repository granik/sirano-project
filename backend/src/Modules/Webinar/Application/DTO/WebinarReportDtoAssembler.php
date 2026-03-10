<?php

namespace App\Modules\Webinar\Application\DTO;


use App\Infrastructure\Files\File;
use App\Shared\Application\DTO\DtoAssembler;
use App\Modules\Webinar\Domain\Entity\WebinarReport;

final class WebinarReportDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new WebinarReportDto();
    }
    
    /**
     * @param WebinarReportDto $dto
     * @param WebinarReport    $entity
     */
    protected function fill($dto, $entity)
    {
        if (!$entity->getWebinar()->getReport() instanceof WebinarReport) {
            return;
        }
        
        $dto->subtitle          = $entity->getSubtitle();
        $dto->youtubeCode       = $entity->getYoutubeCode();
        $dto->description       = $entity->getDescription();
        $dto->image             = $entity->getImage();
        $dto->imageFile         = $entity->getImage() === null
            ? null
            : (new File())->setFilePath($entity->getImage());
        $dto->announceImage     = $entity->getImage();
        $dto->announceImageFile = $entity->getAnnounceImage() === null
            ? null
            : (new File())->setFilePath($entity->getAnnounceImage());
    }
}