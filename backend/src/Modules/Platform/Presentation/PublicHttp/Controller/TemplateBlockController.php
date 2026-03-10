<?php


namespace App\Modules\Platform\Presentation\PublicHttp\Controller;


use App\Modules\Customer\Application\UseCase\Admin\CustomerInteractor;
use App\Modules\Customer\Application\UseCase\PublicSite\DTO\CustomerProfileDtoAssembler;
use App\Modules\Direction\Domain\Entity\Direction;
use App\Modules\Direction\Application\UseCase\PublicSite\FilterDirectionInterface;
use App\Infrastructure\Security\SymfonyUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TemplateBlockController extends AbstractController
{
    /**
     * @var CustomerInteractor
     */
    private $customerInteractor;
    
    /**
     * @var CustomerProfileDtoAssembler
     */
    private $dtoAssembler;
    /**
     * @var FilterDirectionInterface
     */
    private $filterDirection;
    
    /**
     * TemplateBlockController constructor.
     *
     * @param CustomerInteractor          $customerInteractor
     * @param CustomerProfileDtoAssembler $dtoAssembler
     * @param FilterDirectionInterface    $filterDirection
     */
    public function __construct(
        CustomerInteractor $customerInteractor,
        CustomerProfileDtoAssembler $dtoAssembler,
        FilterDirectionInterface $filterDirection
    ) {
        $this->customerInteractor = $customerInteractor;
        $this->dtoAssembler       = $dtoAssembler;
        $this->filterDirection    = $filterDirection;
    }
    
    public function profile()
    {
        /** @var SymfonyUser $symfonyUser */
        $symfonyUser = $this->getUser();
        $customer    = $this->customerInteractor->getCustomer($symfonyUser->getUser());
        $dto         = $this->dtoAssembler->assemble($customer);
        
        return $this->render('frontend/partials/profile.html.twig', [
            'dto' => $dto,
        ]);
    }
    
    public function mobileProfile()
    {
        /** @var SymfonyUser $symfonyUser */
        $symfonyUser = $this->getUser();
        $customer    = $this->customerInteractor->getCustomer($symfonyUser->getUser());
        $dto         = $this->dtoAssembler->assemble($customer);
        
        return $this->render('frontend/partials/mobile-profile.html.twig', [
            'dto' => $dto,
        ]);
    }
    
    public function direction()
    {
        $direction = $this->filterDirection->getSelectedDirection();
        
        $directionName = null;
        if ($direction instanceof Direction) {
            $directionName = $direction->getName();
        }
        
        return $this->render('frontend/partials/direction.html.twig', [
            'directionName' => $directionName,
        ]);
    }
}