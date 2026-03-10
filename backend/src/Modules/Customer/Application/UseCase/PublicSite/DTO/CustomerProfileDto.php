<?php


namespace App\Modules\Customer\Application\UseCase\PublicSite\DTO;


final class CustomerProfileDto
{
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $avatar;
    
    /**
     * @var string
     */
    public $mainSpecialty;
    
    /**
     * @var string|null
     */
    public $additionalSpecialty;
}