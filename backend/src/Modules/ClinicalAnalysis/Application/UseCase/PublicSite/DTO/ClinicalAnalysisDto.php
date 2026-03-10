<?php


namespace App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\DTO;


use App\Modules\LearningModule\Application\UseCase\PublicSite\DTO\ModuleDto;

final class ClinicalAnalysisDto
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string Название
     */
    public $name;
    
    /**
     * @var string
     */
    public $directionName;
    
    /**
     * @var int Порядковый номер
     */
    public $number;
    
    /**
     * @var array
     */
    public $slides;
    
    /**
     * @var array
     */
    public $articles;
    
    /**
     * @var ModuleDto
     */
    public $module;
    
    /**
     * @var string
     */
    public $category;
}