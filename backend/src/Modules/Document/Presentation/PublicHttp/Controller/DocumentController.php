<?php


namespace App\Modules\Document\Presentation\PublicHttp\Controller;


use App\Modules\Document\Application\UseCase\PublicSite\DTO\DocumentDtoAssembler;
use App\Modules\Document\Application\UseCase\PublicSite\DocumentInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class DocumentController extends AbstractController
{
    const PER_PAGE = 12;
    /**
     * @var DocumentInteractor
     */
    private $interactor;
    /**
     * @var DocumentDtoAssembler
     */
    private $dtoAssembler;
    
    /**
     * DocumentController constructor.
     *
     * @param DocumentInteractor   $interactor
     * @param DocumentDtoAssembler $dtoAssembler
     */
    public function __construct(DocumentInteractor $interactor, DocumentDtoAssembler $dtoAssembler)
    {
        $this->interactor   = $interactor;
        $this->dtoAssembler = $dtoAssembler;
    }
    
    public function index(Request $request)
    {
        $page  = $request->query->get('page', 1);
        $limit = $request->query->get('limit', self::PER_PAGE);
        
        $list     = $this->interactor->list($page, $limit);
        $entities = $this->dtoAssembler->assembleList($list);
        
        $pages = ceil($list->count() / $limit);
        
        return $this->render(
            'frontend/documents/list.html.twig',
            [
                'list'  => $entities,
                'page'  => $page,
                'pages' => $pages,
                'limit' => $limit,
            ]
        );
    }
}