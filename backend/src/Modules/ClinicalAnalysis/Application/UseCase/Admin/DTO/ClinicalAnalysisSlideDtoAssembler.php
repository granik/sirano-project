<?php

namespace App\Modules\ClinicalAnalysis\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysisSlide;
use App\Shared\Application\DTO\DtoAssembler;

final class ClinicalAnalysisSlideDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ClinicalAnalysisSlideDto();
    }
    
    /**
     * @param ClinicalAnalysisSlideDto $dto
     * @param ClinicalAnalysisSlide    $entity
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