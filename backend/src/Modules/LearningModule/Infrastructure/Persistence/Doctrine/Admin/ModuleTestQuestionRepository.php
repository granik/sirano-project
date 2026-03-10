<?php

namespace App\Modules\LearningModule\Infrastructure\Persistence\Doctrine\Admin;


use App\Modules\LearningModule\Domain\Repository\Admin\ModuleTestQuestionRepositoryInterface;
use App\Modules\LearningModule\Domain\Entity\ModuleTestQuestion;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ModuleTestQuestionRepository implements ModuleTestQuestionRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    
    /** @var ObjectRepository */
    private $objectRepository;
    /**
     * @var ObjectRepository
     */
    private $slideRepository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager    = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(ModuleTestQuestion::class);
    }
    
    public function find($id): ?ModuleTestQuestion
    {
        return $this->objectRepository->find($id);
    }
}