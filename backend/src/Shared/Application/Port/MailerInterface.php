<?php

namespace App\Shared\Application\Port;


use App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\DTO\ClinicalAnalysisMessage;
use App\Modules\Identity\Repository\User;
use App\Modules\Webinar\Application\DTO\WebinarMessage;
use App\Modules\Webinar\Application\DTO\WebinarRegistrationMessage;

interface MailerInterface
{
    public function sendConfirmationEmail(User $user);
    
    public function sendRestoreUserPasswordEmail(User $user, string $password);
    
    public function sendWebinarMessage(WebinarMessage $webinarMessage);
    
    public function sendClinicalAnalysisMessage(ClinicalAnalysisMessage $message);
    
    public function sendClinicalAnalysisCompanyMessage(ClinicalAnalysisMessage $message);
    
    public function sendConfirmationFromFileEmail(string $email, string $code, int $password);
    
    public function sendRepeatedConfirmationEmailFromFile(string $email, string $code, string $password);
    
    public function sendRepeatedConfirmationEmailFromSite(string $email, string $code, string $password);
    
    public function sendRegistrationForWebinarEmail(string $email, WebinarRegistrationMessage $message);
    
    public function sendRemindAboutWebinarEmail(string $email, WebinarRegistrationMessage $message);
}