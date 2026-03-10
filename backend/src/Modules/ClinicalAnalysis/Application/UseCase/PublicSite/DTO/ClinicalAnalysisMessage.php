<?php


namespace App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\DTO;


final class ClinicalAnalysisMessage
{
    public $to;
    public $name;
    public $direction;
    public $subscriberName;
    public $subscriberEmail;
    public $text;
}