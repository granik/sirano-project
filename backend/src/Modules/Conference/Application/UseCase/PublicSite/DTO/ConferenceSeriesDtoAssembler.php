<?php


namespace App\Modules\Conference\Application\UseCase\PublicSite\DTO;


use App\Modules\Conference\Domain\Entity\ConferenceSeries;
use App\Modules\Conference\Domain\Entity\DTO\ConferenceDtoAssembler;
use App\Shared\Application\DTO\DtoAssembler;

final class ConferenceSeriesDtoAssembler extends DtoAssembler
{
    /**
     * @var string
     */
    private $fileUrlPrefix;
    /**
     * @var ConferenceDtoAssembler
     */
    private $conferenceDtoAssembler;
    
    /**
     * ConferenceSeriesDtoAssembler constructor.
     *
     * @param ConferenceDtoAssembler $conferenceDtoAssembler
     * @param string                 $fileUrlPrefix
     */
    public function __construct(ConferenceDtoAssembler $conferenceDtoAssembler, string $fileUrlPrefix)
    {
        $this->conferenceDtoAssembler = $conferenceDtoAssembler;
        $this->fileUrlPrefix          = $fileUrlPrefix;
    }
    
    protected function createDto()
    {
        return new ConferenceSeriesDto();
    }
    
    /**
     * @param ConferenceSeriesDto $dto
     * @param ConferenceSeries    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->name          = $entity->getName();
        $dto->directionName = $entity->getDirection()->getName();
        
        $image      = $entity->getDirection()->getImage();
        $dto->image = empty($image) ? '' : $this->fileUrlPrefix . '/' . $image;
        
        $dto->conferences = $this->conferenceDtoAssembler->assembleList($entity->getConferences());
    }
}