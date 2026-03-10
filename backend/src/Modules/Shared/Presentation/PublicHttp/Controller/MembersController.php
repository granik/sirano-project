<?php


namespace App\Modules\Shared\Presentation\PublicHttp\Controller;


use App\Modules\Customer\Application\UseCase\PublicSite\DTO\CustomerDtoAssembler;
use App\Modules\Customer\Application\UseCase\PublicSite\CustomerInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class MembersController extends AbstractController
{
    const PER_PAGE = 12;
    /**
     * @var CustomerInteractor
     */
    private $interactor;
    /**
     * @var CustomerDtoAssembler
     */
    private $dtoAssembler;
    
    /**
     * CustomerController constructor.
     *
     * @param CustomerInteractor   $interactor
     * @param CustomerDtoAssembler $dtoAssembler
     */
    public function __construct(CustomerInteractor $interactor, CustomerDtoAssembler $dtoAssembler)
    {
        $this->interactor   = $interactor;
        $this->dtoAssembler = $dtoAssembler;
    }
    
    public function index(Request $request)
    {
        $page  = $request->query->get('page', 1);
        $limit = $request->query->get('limit', self::PER_PAGE);
        $query = $request->query->get('s', null);
        
        $list     = $this->interactor->list($page, $limit, $query);
        $entities = $this->dtoAssembler->assembleList($list);
        
        $pages = ceil($list->count() / $limit);
        
        return $this->render(
            'frontend/members/list.html.twig',
            [
                'list'  => $entities,
                'page'  => $page,
                'pages' => $pages,
                'limit' => $limit,
            ]
        );
    }
}