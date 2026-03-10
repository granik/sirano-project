<?php


namespace App\Modules\News\Domain\Repository\PublicSite;


use App\Modules\News\Domain\Entity\News;

interface NewsRepositoryInterface
{
    public function list(int $page, int $perPage);
    
    public function find($id);
    
    public function randomNews(News $news);
    
    public function mainPage(int $limit, $direction);
}