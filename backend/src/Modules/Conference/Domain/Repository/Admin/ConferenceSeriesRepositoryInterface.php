<?php


namespace App\Modules\Conference\Domain\Repository\Admin;

use App\Modules\Conference\Domain\Entity\Conference;


use App\Modules\Conference\Domain\Entity\ConferenceSeries;

interface ConferenceSeriesRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function store(ConferenceSeries $conferenceSeries);
    
    public function find($id);
    
    public function update(ConferenceSeries $conferenceSeries);
    
    public function delete($entity);
    
    public function listAll();
}