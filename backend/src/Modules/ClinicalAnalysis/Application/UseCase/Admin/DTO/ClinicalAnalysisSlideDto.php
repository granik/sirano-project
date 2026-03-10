<?php

namespace App\Modules\ClinicalAnalysis\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;

final class ClinicalAnalysisSlideDto
{
    /** @var int */
    public $id;
    
    /** @var string Заголовок */
    public $name;
    
    /** @var string */
    public $image;
    
    /** @var File */
    public $imageFile;
    
    /** @var int Порядковый номер */
    public $number;
}