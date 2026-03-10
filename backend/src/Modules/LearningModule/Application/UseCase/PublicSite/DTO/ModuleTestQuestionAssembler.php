<?php

namespace App\Modules\LearningModule\Application\UseCase\PublicSite\DTO;


use App\Modules\LearningModule\Domain\Entity\ModuleTestQuestion;
use App\Shared\Application\DTO\DtoAssembler;

final class ModuleTestQuestionAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ModuleTestQuestionDto();
    }
    
    /**
     * @param ModuleTestQuestionDto $dto
     * @param ModuleTestQuestion    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->id          = $entity->getId();
        $dto->question    = $entity->getQuestion();
        $dto->answer1     = $entity->getAnswer1();
        $dto->answer2     = $entity->getAnswer2();
        $dto->answer3     = $entity->getAnswer3();
        $dto->answer4     = $entity->getAnswer4();
        $dto->rightAnswer = $entity->getRightAnswer();
    }
}