<?php


namespace App\Modules\News\Application\UseCase\PublicSite\DTO;


final class NewsDto
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
    public $directionName;
    
    /**
     * @var string
     */
    public $createdAt;
    
    /**
     * @var string
     */
    public $text;
    
    /**
     * @var string
     */
    public $announceImage;
    
    /**
     * @var string
     */
    public $image;
}