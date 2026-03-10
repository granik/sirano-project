<?php

namespace App\Modules\Conference\Domain\Entity\DTO;


final class ConferenceSubscriberDto
{
    /**
     * @var string
     */
    public $customerName;
    
    /**
     * @var string
     */
    public $customerEmail;
    
    /**
     * @var bool
     */
    public $visit;
    
    /**
     * @var int
     */
    public $customerId;
}