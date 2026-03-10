<?php


namespace App\Shared\Domain\Service;


use App\Modules\Webinar\Domain\Entity\Webinar;

interface UrlGeneratorInterface
{
    public function urlForWebinar(Webinar $webinar);
}