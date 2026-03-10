<?php


namespace App\Modules\News\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;
use App\Modules\Direction\Domain\Entity\Direction;

final class NewsDto
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
     * @var Direction Направление
     */
    public $direction;
    
    /**
     * @var \DateTime Дата публикации
     */
    public $createdAt;
    
    /**
     * @var string|null Изображение анонса
     */
    public $announceImage;
    
    /**
     * @var File|null
     */
    public $announceImageFile;
    
    /**
     * @var string Изображение новости
     */
    public $image;
    
    /**
     * @var File
     */
    public $imageFile;
    
    /**
     * @var string Текст новости
     */
    public $text;
    
    /**
     * @var boolean
     */
    public $isActive;
    
    /**
     * @var string
     */
    public $createdAtString;
}