<?php


namespace App\Modules\Analytics\Application\UseCase\PublicSite;


interface CounterInterface
{
    public function getTodayViews();
    
    public function getAllViews();
}