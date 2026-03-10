<?php


namespace App\Modules\Customer\Application\UseCase\PublicSite\DTO;


use App\Modules\Customer\Domain\Entity\Customer;
use App\Modules\Customer\Domain\Entity\Interactor\CustomerCityNameInteractor;
use App\Shared\Application\DTO\DtoAssembler;

final class CustomerDtoAssembler extends DtoAssembler
{
    /**
     * @var CustomerCityNameInteractor
     */
    private $customerCityNameInteractor;
    
    /**
     * CustomerDtoAssembler constructor.
     *
     * @param CustomerCityNameInteractor $customerCityNameInteractor
     */
    public function __construct(CustomerCityNameInteractor $customerCityNameInteractor)
    {
        $this->customerCityNameInteractor = $customerCityNameInteractor;
    }
    
    protected function createDto()
    {
        return new CustomerDto();
    }
    
    /**
     * @param CustomerDto $dto
     * @param Customer    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->name = $entity->getLastname() . ' ' . $entity->getName();
        if (!empty($entity->getMiddlename())) {
            $dto->name .= ' ' . $entity->getMiddlename();
        }
        
        $dto->cityName = $this->customerCityNameInteractor->getCityName($entity);
    }
}