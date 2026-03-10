<?php


namespace App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite;


use App\Modules\Customer\Application\UseCase\Admin\CustomerInteractor;
use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysis;
use App\Modules\ClinicalAnalysis\Domain\Repository\PublicSite\ClinicalAnalysisRepositoryInterface;
use App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\DTO\ClinicalAnalysisMessage;
use App\Modules\LearningModule\Domain\Entity\Module;
use App\Modules\Identity\Repository\User;
use App\Shared\Application\Port\MailerInterface;

final class ClinicalAnalysisInteractor
{
    /**
     * @var ClinicalAnalysisRepositoryInterface
     */
    private $repository;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var CustomerInteractor
     */
    private $customerInteractor;
    
    /**
     * ClinicalAnalysisInteractor constructor.
     *
     * @param ClinicalAnalysisRepositoryInterface $repository
     * @param CustomerInteractor                  $customerInteractor
     * @param MailerInterface                     $mailer
     */
    public function __construct(
        ClinicalAnalysisRepositoryInterface $repository,
        CustomerInteractor $customerInteractor,
        MailerInterface $mailer
    ) {
        $this->repository         = $repository;
        $this->mailer             = $mailer;
        $this->customerInteractor = $customerInteractor;
    }
    
    public function list(int $page, int $perPage, $direction, $category)
    {
        return $this->repository->list($page, $perPage, $direction, $category);
    }
    
    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    public function sendMessage(ClinicalAnalysis $entity, User $user, string $text)
    {
        $message            = new ClinicalAnalysisMessage();
        $message->to        = $entity->getLecturerEmail();
        $message->name      = $entity->getName();
        $message->direction = $entity->getDirection()->getName();
        $message->text      = $text;
        
        $customer = $this->customerInteractor->getCustomer($user);
        
        $message->subscriberName  = $customer->getLastname() . ' ' . $customer->getName() . ' ' . $customer->getMiddlename();
        $message->subscriberEmail = $customer->getEmail();
        
        $this->mailer->sendClinicalAnalysisMessage($message);
    }
    
    public function sendCompanyMessage(ClinicalAnalysis $entity, User $user, string $text)
    {
        $message            = new ClinicalAnalysisMessage();
        $message->to        = $entity->getLecturerEmail();
        $message->name      = $entity->getName();
        $message->direction = $entity->getDirection()->getName();
        $message->text      = $text;
    
        $customer = $this->customerInteractor->getCustomer($user);
    
        $message->subscriberName  = $customer->getLastname() . ' ' . $customer->getName() . ' ' . $customer->getMiddlename();
        $message->subscriberEmail = $customer->getEmail();
    
        $this->mailer->sendClinicalAnalysisCompanyMessage($message);
    }
    
    public function findByModule(Module $module)
    {
        return $this->repository->findByModule($module);
    }
}