<?php


namespace App\Modules\ClinicalAnalysis\Application\UseCase\Admin\DTO;


use App\Modules\Article\Domain\Entity\Article;
use App\Modules\Direction\Domain\Entity\Direction;
use App\Modules\LearningModule\Domain\Entity\Module;

final class ClinicalAnalysisDto
{
    /** @var int */
    public $id;
    
    /** @var string Название */
    public $name;
    
    /** @var \App\Modules\Direction\Domain\Entity\Direction Направление */
    public $direction;
    
    /** @var Module Модуль */
    public $module;
    
    /** @var int Порядковый номер */
    public $number;
    
    /** @var ClinicalAnalysisSlide[] Слайды для слайдера */
    public $slides = [];
    
    /** @var Article[] Материалы по теме модуля */
    public $articles = [];
    
    /** @var string|null */
    public $companyEmail;
    
    /** @var string|null */
    public $lecturerEmail;
    
    /** @var boolean */
    public $isActive;
    
    public $category;
}