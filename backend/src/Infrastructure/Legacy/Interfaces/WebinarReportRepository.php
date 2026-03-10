<?php

namespace App\Infrastructure\Legacy\Interfaces;


use App\Modules\Webinar\Domain\Entity\WebinarReport;
use App\Modules\Webinar\Domain\Repository\WebinarReportRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class WebinarReportRepository implements WebinarReportRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    
    /** @var ObjectRepository */
    private $objectRepository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager    = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(WebinarReport::class);
    }
    
    public function store(WebinarReport $report)
    {
        $this->entityManager->persist($report);
        $this->entityManager->flush();
    }
    
    public function update(WebinarReport $report)
    {
        $this->entityManager->flush();
    }
}