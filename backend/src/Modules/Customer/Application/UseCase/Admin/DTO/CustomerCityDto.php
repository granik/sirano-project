<?php


namespace App\Modules\Customer\Application\UseCase\Admin\DTO;


final class CustomerCityDto
{
    /**
     * @var string|null
     */
    public $kladrId;
    
    /**
     * @var string
     */
    public $country;
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $fullName;
}