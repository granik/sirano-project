<?php


namespace App\Modules\Document\Application\UseCase\PublicSite;


use App\Modules\Document\Domain\Repository\PublicSite\DocumentRepositoryInterface;

final class DocumentInteractor
{
    /**
     * @var DocumentRepositoryInterface
     */
    private $repository;
    
    /**
     * DocumentInteractor constructor.
     *
     * @param DocumentRepositoryInterface $repository
     */
    public function __construct(DocumentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list(int $page, int $perPage)
    {
        return $this->repository->list($page, $perPage);
    }
}