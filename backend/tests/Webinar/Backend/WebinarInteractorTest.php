<?php

namespace App\Webinar\Backend;

use App\Modules\Direction\Application\UseCase\Admin\DirectionInteractor;
use App\Infrastructure\Files\FileUploader;
use App\Infrastructure\Files\TableWriterInterface;
use App\Modules\Direction\Domain\Repository\Admin\CategoryRepositoryInterface;
use App\Modules\Direction\Domain\Repository\DirectionRepositoryInterface;
use App\Tests\Builders\CustomerBuilder;
use App\Modules\Webinar\Domain\Entity\Webinar;
use App\Modules\Webinar\Domain\Repository\WebinarReportRepositoryInterface;
use App\Modules\Webinar\Domain\Entity\WebinarSubscriber;
use PHPUnit\Framework\TestCase;

class WebinarInteractorTest extends TestCase
{
    
    public function testSaveSubscribers()
    {
        $customerBuilder = CustomerBuilder::instance();
        
        $webinarRepository = $this->createMock(WebinarRepositoryInterface::class);
        $webinarRepository
            ->method('find')
            ->willReturn(
                (new Webinar())
                    ->setSubscribers([
                        (new WebinarSubscriber())
                            ->setCustomer($customerBuilder->build())
                    ])
            );
        $webinarReportRepository = $this->createMock(WebinarReportRepositoryInterface::class);
        $directionRepository     = $this->createMock(DirectionRepositoryInterface::class);
        $categoryRepository      = $this->createMock(CategoryRepositoryInterface::class);
        $tableWriter             = $this->getMockBuilder(TableWriterInterface::class)->setMethods(['write'])->getMock();
        $list                    = [
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
                '+7(000)000-00-00',
                'user@example.com',
                0,
            ],
        ];
        $tableWriter->expects($this->once())
            ->method('write')
            ->with($this->identicalTo($list));
        
        $fileUploader        = new FileUploader('target_dir');
        $directionInteractor = new DirectionInteractor(
            $directionRepository,
            $categoryRepository,
            $fileUploader,
            'target_dir'
        );
        
        $webinarInteractor = new WebinarInteractor(
            $webinarRepository,
            $directionInteractor,
            $webinarReportRepository,
            $fileUploader,
            $tableWriter
        );
        
        $webinarInteractor->saveSubscribers(1);
    }
}
