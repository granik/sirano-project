<?php


namespace App\Modules\ClinicalAnalysis\Domain\Repository\PublicSite;


use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysis;
use App\Modules\LearningModule\Domain\Entity\Module;

interface ClinicalAnalysisRepositoryInterface
{
    public function list(int $page, int $perPage, $direction, $category);

    public function find($id);
    
    public function findByModule(Module $module): ?ClinicalAnalysis;
}