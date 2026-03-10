<?php

namespace App\Modules\Webinar\Domain\Repository;

use App\Modules\Webinar\Domain\Entity\Webinar;
use App\Modules\Webinar\Domain\Entity\WebinarReport;


interface WebinarReportRepositoryInterface
{
    public function store(WebinarReport $report);
    
    public function update(WebinarReport $report);
}