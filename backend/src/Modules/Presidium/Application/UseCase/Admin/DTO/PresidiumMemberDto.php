<?php


namespace App\Modules\Presidium\Application\UseCase\Admin\DTO;


use App\Infrastructure\Files\File;

final class PresidiumMemberDto
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
     * @var string|null
     */
    public $middlename;
    
    /**
     * @var string
     */
    public $lastname;
    
    /**
     * @var string
     */
    public $image;
    
    /**
     * @var File
     */
    public $imageFile;
    
    /**
     * @var string
     */
    public $description;
    
    /**
     * @var bool
     */
    public $isActive;
    
    /**
     * @var int
     */
    public $number;
}