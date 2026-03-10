<?php


namespace App\Modules\Analytics\Application\UseCase\PublicSite;


final class CounterInteractor
{
    /**
     * @var CounterInterface
     */
    private $counter;
    
    /**
     * CounterInteractor constructor.
     *
     * @param CounterInterface $counter
     */
    public function __construct(CounterInterface $counter)
    {
        $this->counter = $counter;
    }
    
    public function getTodayViews()
    {
        return $this->counter->getTodayViews();
    }
    
    public function getAllViews()
    {
        return $this->counter->getAllViews();
    }
}