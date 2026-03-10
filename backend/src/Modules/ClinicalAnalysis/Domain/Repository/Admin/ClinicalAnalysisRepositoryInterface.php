<?php


namespace App\Modules\ClinicalAnalysis\Domain\Repository\Admin;


use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysisSlide;
use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysis;

interface ClinicalAnalysisRepositoryInterface
{
    public function list(int $page, int $perPage, array $criteria);
    
    public function store(ClinicalAnalysis $entity);
    
    public function find($id);
    
    public function update(ClinicalAnalysis $entity);
    
    public function storeSlide(ClinicalAnalysisSlide $slide);
    
    public function delete($entity);
    
    public function deleteSlidesByIds(array $deleteIds);
}