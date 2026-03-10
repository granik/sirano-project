<?php


namespace App\Modules\LearningModule\Application\UseCase\Admin\DTO;


use App\Modules\Article\Domain\Entity\Article;
use App\Shared\Application\DTO\DtoAssembler;

final class ModuleArticleDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ModuleArticleDto();
    }
    
    /**
     * @param ModuleArticleDto $dto
     * @param Article          $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id   = $entity->getId();
        $dto->name = $entity->getName();
    }
}