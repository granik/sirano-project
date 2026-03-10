<?php


namespace App\Modules\Conference\Application\UseCase\PublicSite;


use App\Modules\Conference\Domain\Repository\PublicSite\ConferenceSeriesRepositoryInterface;

final class ConferenceSeriesInteractor
{
    /**
     * @var ConferenceSeriesRepositoryInterface
     */
    private $repository;
    
    /**
     * ConferenceSeriesInteractor constructor.
     *
     * @param ConferenceSeriesRepositoryInterface $repository
     */
    public function __construct(ConferenceSeriesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function list(int $limit, $direction)
    {
        return $this->repository->list($limit, $direction);
    }
}