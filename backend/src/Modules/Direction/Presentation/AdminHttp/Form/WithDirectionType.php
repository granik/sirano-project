<?php

namespace App\Modules\Direction\Presentation\AdminHttp\Form;


use App\Modules\Direction\Application\UseCase\Admin\DirectionInteractor;
use App\Modules\Direction\Domain\Entity\Direction;
use Symfony\Component\Form\AbstractType;

class WithDirectionType extends AbstractType
{
    /**
     * @var DirectionInteractor
     */
    protected $directionInteractor;
    
    /**
     * WithDirectionType constructor.
     *
     * @param DirectionInteractor $directionInteractor
     */
    public function __construct(DirectionInteractor $directionInteractor)
    {
        $this->directionInteractor = $directionInteractor;
    }
    
    protected function getDirectionChoices()
    {
        $choices = [];
        
        /** @var Direction $direction */
        foreach ($this->directionInteractor->activeList() as $direction) {
            $choices[$direction->getName()] = $direction->getId();
        }
        
        return $choices;
    }
}