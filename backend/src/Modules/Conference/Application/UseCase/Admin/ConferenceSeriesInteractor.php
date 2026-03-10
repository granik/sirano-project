<?php


namespace App\Modules\Conference\Application\UseCase\Admin;

use App\Modules\Direction\Application\UseCase\Admin\DirectionInteractor;

use App\Modules\Platform\Application\UseCase\Admin\DeleteInteractor;


use App\Modules\Conference\Domain\Repository\Admin\ConferenceSeriesRepositoryInterface;
use App\Modules\Conference\Application\UseCase\Admin\DTO\ConferenceSeriesDto;
use App\Modules\Conference\Domain\Entity\ConferenceSeries;
use App\Modules\Direction\Domain\Entity\Direction;
use App\Shared\Application\Port\NonExistentEntity;

final class ConferenceSeriesInteractor
{
    use DeleteInteractor;
    
    /**
     * @var ConferenceSeriesRepositoryInterface
     */
    private $repository;
    /**
     * @var DirectionInteractor
     */
    private $directionInteractor;
    
    /**
     * ConferenceSeriesInteractor constructor.
     *
     * @param ConferenceSeriesRepositoryInterface $repository
     * @param DirectionInteractor                 $directionInteractor
     */
    public function __construct(
        ConferenceSeriesRepositoryInterface $repository,
        DirectionInteractor $directionInteractor
    ) {
        $this->repository          = $repository;
        $this->directionInteractor = $directionInteractor;
    }
    
    public function list(int $page, int $perPage)
    {
        return $this->repository->list($page, $perPage);
    }
    
    /**
     * @param ConferenceSeriesDto $conferenceSeriesDto
     *
     * @return ConferenceSeries
     * @throws NonExistentEntity
     */
    public function create(ConferenceSeriesDto $conferenceSeriesDto)
    {
        $conferenceSeries = new ConferenceSeries();
        
        $conferenceSeries = $this->fillEntity($conferenceSeries, $conferenceSeriesDto);
        
        $this->repository->store($conferenceSeries);
        
        return $conferenceSeries;
    }
    
    /**
     * @param ConferenceSeriesDto $conferenceSeriesDto
     *
     * @return mixed
     * @throws NonExistentEntity
     */
    public function update(ConferenceSeriesDto $conferenceSeriesDto)
    {
        $conferenceSeries = $this->find($conferenceSeriesDto->id);
        
        if (!$conferenceSeries instanceof ConferenceSeries) {
            throw new NonExistentEntity();
        }
        
        $conferenceSeries = $this->fillEntity($conferenceSeries, $conferenceSeriesDto);
        
        return $this->repository->update($conferenceSeries);
    }
    
    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    public function listAll()
    {
        return $this->repository->listAll();
    }
    
    /**
     * @param ConferenceSeries    $conferenceSeries
     * @param ConferenceSeriesDto $conferenceSeriesDto
     *
     * @return ConferenceSeries
     * @throws NonExistentEntity
     */
    private function fillEntity(
        ConferenceSeries $conferenceSeries,
        ConferenceSeriesDto $conferenceSeriesDto
    ): ConferenceSeries {
        $direction = $this->directionInteractor->find($conferenceSeriesDto->direction);
        
        if (!$direction instanceof Direction) {
            throw new NonExistentEntity();
        }
        
        $conferenceSeries
            ->setName($conferenceSeriesDto->name)
            ->setDirection($direction);
        
        return $conferenceSeries;
    }
}