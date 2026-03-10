<?php


namespace App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\DTO;


use App\Modules\Article\Application\UseCase\PublicSite\DTO\ArticleDtoAssembler;
use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysis;
use App\Modules\LearningModule\Application\UseCase\PublicSite\DTO\ModuleDtoAssembler;
use App\Shared\Application\DTO\DtoAssembler;

final class ClinicalAnalysisDtoAssembler extends DtoAssembler
{
    /**
     * @var ArticleDtoAssembler
     */
    private $articleDtoAssembler;
    /**
     * @var string
     */
    private $fileUrlPrefix;
    /**
     * @var ModuleDtoAssembler
     */
    private $moduleDtoAssembler;
    
    /**
     * ClinicalAnalysisDtoAssembler constructor.
     *
     * @param string              $fileUrlPrefix
     * @param ArticleDtoAssembler $articleDtoAssembler
     * @param ModuleDtoAssembler  $moduleDtoAssembler
     */
    public function __construct(
        string $fileUrlPrefix,
        ArticleDtoAssembler $articleDtoAssembler,
        ModuleDtoAssembler $moduleDtoAssembler
    ) {
        $this->articleDtoAssembler = $articleDtoAssembler;
        $this->fileUrlPrefix       = $fileUrlPrefix;
        $this->moduleDtoAssembler  = $moduleDtoAssembler;
    }
    
    protected function createDto()
    {
        return new ClinicalAnalysisDto();
    }
    
    /**
     * @param ClinicalAnalysisDto $dto
     * @param ClinicalAnalysis    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id            = $entity->getId();
        $dto->name          = $entity->getName();
        $dto->directionName = $entity->getDirection()->getName();
        $dto->category      = $entity->getCategory() === null ? '' : $entity->getCategory()->getName();
        $dto->number        = $entity->getNumber();
        
        foreach ($entity->getSlides() as $slide) {
            $dto->slides[] = $this->fileUrlPrefix . '/' . $slide->getImage();
        }
        
        $dto->articles = $this->articleDtoAssembler->assembleList($entity->getArticles());
        $dto->module   = $this->moduleDtoAssembler->assemble($entity->getModule());
    }
}