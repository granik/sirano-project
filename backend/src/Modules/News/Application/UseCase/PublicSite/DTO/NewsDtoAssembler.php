<?php


namespace App\Modules\News\Application\UseCase\PublicSite\DTO;


use App\Modules\News\Domain\Entity\News;
use App\Shared\Application\DTO\DtoAssembler;

final class NewsDtoAssembler extends DtoAssembler
{
    /**
     * @var string
     */
    private $fileUrlPrefix;
    
    /**
     * NewsDtoAssembler constructor.
     *
     * @param string $fileUrlPrefix
     */
    public function __construct(string $fileUrlPrefix)
    {
        $this->fileUrlPrefix = $fileUrlPrefix;
    }
    
    protected function createDto()
    {
        return new NewsDto();
    }
    
    /**
     * @param NewsDto $dto
     * @param News    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id            = $entity->getId();
        $dto->name          = $entity->getName();
        $dto->directionName = $entity->getDirection()->getName();
        $dto->createdAt     = self::getRussianDate($entity->getCreatedAt());
        $dto->text          = $entity->getText();
        $dto->announceImage = empty($entity->getAnnounceImage())
            ? ''
            : $this->fileUrlPrefix . '/' . $entity->getAnnounceImage();
        $dto->image         = $this->fileUrlPrefix . '/' . $entity->getImage();
    }
}