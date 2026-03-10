<?php


namespace App\Modules\Specialty\Presentation\AdminHttp\Controller;

use App\Modules\Platform\Presentation\AdminHttp\Controller\DeleteController;


use App\Modules\Specialty\Presentation\AdminHttp\Form\SpecialtyType;
use App\Modules\Specialty\Application\UseCase\Admin\MainSpecialtyInteractor;
use App\Modules\Specialty\Application\UseCase\Admin\DTO\SpecialtyDto;
use App\Modules\Specialty\Application\UseCase\Admin\DTO\SpecialtyDtoAssembler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class MainSpecialtyController extends AbstractController
{
    use DeleteController;
    
    const PER_PAGE = 12;
    
    /**
     * @var MainSpecialtyInteractor
     */
    private $interactor;
    /**
     * @var SpecialtyDtoAssembler
     */
    private $dtoAssembler;
    
    /**
     * MainSpecialtyController constructor.
     *
     * @param MainSpecialtyInteractor $interactor
     * @param SpecialtyDtoAssembler   $dtoAssembler
     */
    public function __construct(MainSpecialtyInteractor $interactor, SpecialtyDtoAssembler $dtoAssembler)
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
            'backend/mainSpecialty/list.html.twig',
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
        $dto = new SpecialtyDto();
        
        $form = $this->createForm(SpecialtyType::class, $dto);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $this->interactor->create($dto);
            
            $this->addFlash('notice', 'Специальность создана');
            
            return $this->redirectToRoute('cms_main_specialty_edit', ['id' => $entity->getId()]);
        }
        
        return $this->render('backend/mainSpecialty/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $entity = $this->interactor->find($id);
        $dto    = $this->dtoAssembler->assemble($entity);
        
        $form = $this->createForm(SpecialtyType::class, $dto, ['validation_groups' => ['update']]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->interactor->update($dto);
            
            $this->addFlash('notice', 'Специальность сохранена');
            
            return $this->redirectToRoute('cms_main_specialty_edit', ['id' => $entity->getId()]);
        }
        
        return $this->render('backend/mainSpecialty/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}