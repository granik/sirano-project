<?php


namespace App\Modules\Conference\Application\UseCase\PublicSite\DTO;


final class ConferenceSeriesDto
{
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
    public $image;
    
    /**
     * @var array
     */
    public $conferences;
}