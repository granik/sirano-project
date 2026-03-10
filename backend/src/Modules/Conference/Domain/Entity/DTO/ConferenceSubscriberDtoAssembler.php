<?php

namespace App\Modules\Conference\Domain\Entity\DTO;


use App\Modules\Conference\Domain\Entity\ConferenceSubscriber;
use App\Shared\Application\DTO\DtoAssembler;

final class ConferenceSubscriberDtoAssembler extends DtoAssembler
{
    protected function createDto()
    {
        return new ConferenceSubscriberDto();
    }
    
    /**
     * @param ConferenceSubscriberDto $dto
     * @param ConferenceSubscriber    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->customerId    = $entity->getCustomer()->getId();
        $dto->customerEmail = $entity->getCustomer()->getEmail();
        $dto->customerName  = $entity->getCustomer()->getLastname() . ' ' . $entity->getCustomer()->getName() . ' ' . $entity->getCustomer()->getMiddlename();
        $dto->visit         = $entity->isVisit();
    }
}