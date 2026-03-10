<?php


namespace App\Modules\Article\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Direction\Domain\Entity\Direction;

final class ArticleDto
{
    /** @var int */
    public $id;
    
    /** @var string Название */
    public $name;
    
    /** @var Direction Направление */
    public $direction;
    
    /** @var string Автор */
    public $author;
    
    /** @var string Материал */
    public $file;
    
    /** @var File */
    public $fileFile;
    
    /** @var boolean Опубликован/не опубликован */
    public $isActive;
    
    public $category;
}