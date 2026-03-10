<?php


namespace App\Modules\Customer\Application\UseCase\PublicSite\DTO;


use App\Infrastructure\Files\File;

final class CustomerUpdateDto
{
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $middlename;
    
    /**
     * @var string
     */
    public $lastname;
    
    /**
     * @var string
     */
    public $email;
    
    /**
     * @var string
     */
    public $phone;
    
    /**
     * @var int
     */
    public $directionId;
    
    /**
     * @var File|null
     */
    public $avatarFile;
    
    /**
     * @var string|null
     */
    public $avatar;
    
    /**
     * @var string
     */
    public $cityName;
    
    /**
     * @var int
     */
    public $mainSpecialtyId;
    
    /**
     * @var int|null
     */
    public $additionalSpecialtyId;
    
    /**
     * @var string|null
     */
    public $kladrId;
    
    /**
     * @var string;
     */
    public $country;
    
    /**
     * @var string
     */
    public $fullCityName;
}