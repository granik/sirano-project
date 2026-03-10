<?php

namespace App\Modules\Direction\Domain\Entity\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Direction\Application\UseCase\Admin\DTO\DirectionCategoryDto;

final class DirectionDto
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $icon;
    
    /**
     * @var string
     */
    public $image;
    
    /**
     * @var boolean
     */
    public $isActive;
    
    /**
     * @var File
     */
    public $iconFile;
    
    /**
     * @var File
     */
    public $imageFile;
    
    /**
     * @var bool
     */
    public $isMainPage;
    
    /**
     * @var int|null
     */
    public $number;
    
    /**
     * @var DirectionCategoryDto[]
     */
    public $categories = [];
    
    /**
     * @var File
     */
    public $activeIconFile;
    
    /**
     * @var string
     */
    public $activeIcon;
}