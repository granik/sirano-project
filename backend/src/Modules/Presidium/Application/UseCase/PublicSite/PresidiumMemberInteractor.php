<?php


namespace App\Modules\Presidium\Application\UseCase\PublicSite;


use App\Modules\Presidium\Domain\Repository\PublicSite\PresidiumMemberRepositoryInterface;

final class PresidiumMemberInteractor
{
    /**
     * @var PresidiumMemberRepositoryInterface
     */
    private $repository;

    /**
     * PresidiumMemberInteractor constructor.
     *
     * @param PresidiumMemberRepositoryInterface $repository
     */
    public function __construct(PresidiumMemberRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list(int $page, int $perPage)
    {
        return $this->repository->list($page, $perPage);
    }
}