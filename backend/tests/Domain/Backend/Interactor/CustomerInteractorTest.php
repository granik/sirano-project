<?php

namespace App\Domain\Backend\Interactor;

use App\Modules\Customer\Domain\Repository\Admin\CustomerRepositoryInterface;
use App\Modules\Direction\Application\UseCase\PublicSite\FilterDirectionInterface;
use App\Shared\Application\SettingsInterface;
use App\Modules\Identity\Domain\UserRepositoryInterface;
use App\Modules\Identity\Application\UseCase\UserInteractor;
use App\Shared\Application\Port\MailerInterface;
use App\Shared\Application\Port\UserPasswordEncoderInterface;
use App\Tests\Builders\CustomerBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CustomerInteractorTest extends TestCase
{
    
    public function testSaveList()
    {
        $customerBuilder = CustomerBuilder::instance();
        
        $customerRepository = $this->createMock(CustomerRepositoryInterface::class);
        $customerRepository
            ->method('listAll')
            ->willReturn([
                $customerBuilder->build(),
            ]);
        $mailer              = $this->createMock(MailerInterface::class);
        $userRepository      = $this->createMock(UserRepositoryInterface::class);
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $filterDirection     = $this->createMock(FilterDirectionInterface::class);
        $settings            = $this->createMock(SettingsInterface::class);
        $logger              = $this->createMock(LoggerInterface::class);
        
        $tableWriter = $this->getMockBuilder(TableWriterInterface::class)->setMethods(['write'])->getMock();
        $list        = [
            [
                'Фамилия',
                'Имя',
                'Отчество',
                'Город',
                'Специализация',
                'Посещение',
                'Телефон',
                'Email',
                'Кол-во отметок',
            ],
            [
                'Lastname',
                'Name',
                null,
                'City',
                'Specialty',
                'Не посетил',
                '+7(111)111-11-11',
                'email@example.com',
                0,
            ],
        ];
        $tableWriter->expects($this->once())
            ->method('write')
            ->with($this->identicalTo($list));
        
        $fileUploader   = new FileUploader('target_dir');
        $userInteractor = new UserInteractor(
            $userRepository, $userPasswordEncoder, $mailer, $filterDirection, $settings, $logger
        );
        
        $customerInteractor = new CustomerInteractor(
            $customerRepository,
            $userInteractor,
            $fileUploader,
            $tableWriter,
            $mailer
        );
        
        $customerInteractor->saveList();
    }
}
