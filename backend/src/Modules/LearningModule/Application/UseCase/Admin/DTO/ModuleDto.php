<?php

namespace App\Modules\LearningModule\Application\UseCase\Admin\DTO;


use App\Modules\Direction\Domain\Entity\Direction;

final class ModuleDto
{
    /** @var int */
    public $id;
    
    /** @var string Название */
    public $name;
    
    /** @var \App\Modules\Direction\Domain\Entity\Direction Направление */
    public $direction;
    
    /** @var int Порядковый номер */
    public $number;
    
    public $slides = [];
    
    /** @var string Видео к модулю (youtube) */
    public $youtubeCode;
    
    public $articles = [];
    
    /** @var boolean */
    public $isActive;
    
    public $category;
}