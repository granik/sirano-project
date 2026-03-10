<?php


namespace App\Modules\Conference\Infrastructure\Persistence\Doctrine\PublicSite;


use App\Modules\Conference\Domain\Entity\Conference;
use App\Modules\Conference\Domain\Entity\ConferenceSeries;
use App\Modules\Conference\Domain\Repository\PublicSite\ConferenceSeriesRepositoryInterface;
use App\Modules\Direction\Domain\Entity\Direction;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ConferenceSeriesRepository implements ConferenceSeriesRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var ObjectRepository
     */
    private $objectRepository;
    
    /**
     * @var ObjectRepository
     */
    private $conferenceRepository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager        = $entityManager;
        $this->objectRepository     = $this->entityManager->getRepository(ConferenceSeries::class);
        $this->conferenceRepository = $this->entityManager->getRepository(Conference::class);
    }
    
    public function list(int $limit, $direction)
    {
        $where = '';
        
        if ($direction instanceof Direction) {
            $where = ' AND cs.direction = :direction ';
        }
        
        $dql = 'SELECT cs FROM '
            . ConferenceSeries::class
            . ' cs WHERE EXISTS (SELECT c FROM '
            . Conference::class
            . ' c WHERE c.series = cs) '
            . $where
            . ' ORDER BY cs.name';
        
        $query = $this->entityManager->createQuery($dql)->setMaxResults($limit);
        
        if ($direction instanceof Direction) {
            $query->setParameter('direction', $direction);
        }
        
        $series = $query->getResult();
        
        foreach ($series as $item) {
            $this->hydrate($item);
        }
        
        return $series;
    }
    
    private function hydrate(ConferenceSeries $series)
    {
        $conferences = $this->conferenceRepository->findBy(['series' => $series], ['startDateTime' => 'asc']);
        $series->setConferences($conferences);
    }
}