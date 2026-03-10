<?php


namespace App\Modules\Presidium\Presentation\AdminHttp\Controller;

use App\Modules\Platform\Presentation\AdminHttp\Controller\DeleteController;


use App\Modules\Presidium\Presentation\AdminHttp\Form\PresidiumMemberType;
use App\Modules\Presidium\Application\UseCase\Admin\PresidiumMemberInteractor;
use App\Modules\Presidium\Application\UseCase\Admin\DTO\PresidiumMemberDto;
use App\Modules\Presidium\Application\UseCase\Admin\DTO\PresidiumMemberDtoAssembler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class PresidiumController extends AbstractController
{
    use DeleteController;
    
    const PER_PAGE = 12;
    
    /**
     * @var PresidiumMemberInteractor
     */
    private $interactor;
    /**
     * @var PresidiumMemberDtoAssembler
     */
    private $dtoAssembler;
    
    /**
     * PresidiumMemberController constructor.
     *
     * @param PresidiumMemberInteractor   $interactor
     * @param PresidiumMemberDtoAssembler $dtoAssembler
     */
    public function __construct(PresidiumMemberInteractor $interactor, PresidiumMemberDtoAssembler $dtoAssembler)
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
            'backend/presidium/list.html.twig',
            [
                'list'        => $entities,
                'currentPage' => $page,
                'pages'       => $pages,
                'limit'       => $limit,
            ]
        );
    }
    
    public function create(Request $request)
    {
        $dto = new PresidiumMemberDto();
        
        $form = $this->createForm(PresidiumMemberType::class, $dto);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $this->interactor->create($dto);
            
            $this->addFlash('notice', 'Член президиума создан');
            
            return $this->redirectToRoute('cms_presidium_edit', ['id' => $entity->getId()]);
        }
        
        return $this->render('backend/presidium/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $entity = $this->interactor->find($id);
        $dto    = $this->dtoAssembler->assemble($entity);
        
        $form = $this->createForm(PresidiumMemberType::class, $dto, ['validation_groups' => ['update']]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->interactor->update($dto);
            
            $this->addFlash('notice', 'Член президиума сохранён');
            
            return $this->redirectToRoute('cms_presidium_edit', ['id' => $entity->getId()]);
        }
        
        return $this->render('backend/presidium/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}