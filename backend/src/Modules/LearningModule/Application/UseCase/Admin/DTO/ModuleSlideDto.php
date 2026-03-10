<?php

namespace App\Modules\LearningModule\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;

final class ModuleSlideDto
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