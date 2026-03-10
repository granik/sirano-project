<?php


namespace App\Modules\Conference\Application\UseCase\Admin\DTO;


final class ConferenceSeriesDto
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
     * @var int
     */
    public $direction;
}