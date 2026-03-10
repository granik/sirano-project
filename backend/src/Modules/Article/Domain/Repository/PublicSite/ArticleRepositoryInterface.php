<?php


namespace App\Modules\Article\Domain\Repository\PublicSite;

use App\Modules\Article\Domain\Entity\Article;


interface ArticleRepositoryInterface
{
    public function list(int $page, int $perPage, $direction, $category);
}