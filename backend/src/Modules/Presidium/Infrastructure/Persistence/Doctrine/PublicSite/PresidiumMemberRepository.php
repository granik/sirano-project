<?php


namespace App\Modules\Presidium\Infrastructure\Persistence\Doctrine\PublicSite;


use App\Modules\Presidium\Domain\Entity\PresidiumMember;
use App\Modules\Presidium\Domain\Repository\PublicSite\PresidiumMemberRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class PresidiumMemberRepository implements PresidiumMemberRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager    = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(PresidiumMember::class);
    }

    public function list(int $page, int $perPage)
    {
        $dql   = 'SELECT m FROM ' . PresidiumMember::class . ' m WHERE m.isActive = TRUE ORDER BY m.number';
        $query = $this->entityManager->createQuery($dql)
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage);

        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
    }
}