<?php

namespace App\Shared\Application\DTO;


use App\Modules\Conference\Domain\Entity\ConferenceProgram;
use App\Modules\Conference\Domain\Entity\DTO\ConferenceProgramDto;

final class ConferenceProgramDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ConferenceProgramDto();
    }
    
    /**
     * @param \App\Modules\Conference\Domain\Entity\DTO\ConferenceProgramDto $dto
     * @param ConferenceProgram                                      $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->fromTime       = $entity->getFromTime();
        $dto->tillTime       = $entity->getTillTime();
        $dto->fromTimeString = $entity->getFromTime() === null ? '' : $entity->getFromTime()->format('H:i');
        $dto->tillTimeString = $entity->getTillTime() === null ? '' : $entity->getTillTime()->format('H:i');
        $dto->subject        = $entity->getSubject();
        $dto->lecturers      = $entity->getLecturers();
    }
}