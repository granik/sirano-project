<?php


namespace App\Modules\Article\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Article\Domain\Entity\Article;
use App\Shared\Application\DTO\DtoAssembler;

final class ArticleDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ArticleDto();
    }
    
    /**
     * @param ArticleDto $dto
     * @param Article    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id        = $entity->getId();
        $dto->name      = $entity->getName();
        $dto->author    = $entity->getAuthor();
        $dto->isActive  = $entity->isActive();
        $dto->direction = $entity->getDirection()->getId();
        $dto->category  = $entity->getCategory() === null ? null : $entity->getCategory()->getId();
        $dto->file      = $entity->getFile();
        $dto->fileFile  = (new File())->setFilePath($entity->getFile());
    }
}