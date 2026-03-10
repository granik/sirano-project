<?php

namespace App\Modules\LearningModule\Presentation\AdminHttp\Controller;


use App\Modules\LearningModule\Presentation\AdminHttp\Form\ModuleTestType;
use App\Modules\LearningModule\Application\UseCase\Admin\ModuleInteractor;
use App\Modules\LearningModule\Application\UseCase\Admin\ModuleTestInteractor;
use App\Modules\LearningModule\Application\UseCase\Admin\DTO\ModuleTestDtoAssembler;
use App\Modules\LearningModule\Domain\Entity\ModuleTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

final class ModuleTestController extends AbstractController
{
    const PER_PAGE = 12;
    
    /**
     * @var ModuleInteractor
     */
    private $moduleInteractor;
    /**
     * @var ModuleTestDtoAssembler
     */
    private $dtoAssembler;
    /**
     * @var ModuleTestInteractor
     */
    private $interactor;
    
    /**
     * ModuleController constructor.
     *
     * @param ModuleTestInteractor   $interactor
     * @param ModuleInteractor       $moduleInteractor
     * @param ModuleTestDtoAssembler $dtoAssembler
     */
    public function __construct(
        ModuleTestInteractor $interactor,
        ModuleInteractor $moduleInteractor,
        ModuleTestDtoAssembler $dtoAssembler
    ) {
        $this->interactor       = $interactor;
        $this->moduleInteractor = $moduleInteractor;
        $this->dtoAssembler     = $dtoAssembler;
    }
    
    public function edit(Request $request, $id)
    {
        $module = $this->moduleInteractor->find($id);
        $entity = $this->moduleInteractor->getTest($module);
        $dto    = $this->dtoAssembler->assemble($entity);
        
        $form = $this->createForm(ModuleTestType::class, $dto);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $this->interactor->update($module, $dto);
            
            if (empty($errors)) {
                $this->addFlash('notice', 'Тест сохранён');
    
                return $this->redirectToRoute('cms_module_test', ['id' => $module->getId()]);
            }
            
            foreach ($errors as $error) {
                $form->addError(new FormError($error));
            }
        }
        
        return $this->render('backend/module/test.html.twig', [
            'form'            => $form->createView(),
            'questionsNumber' => ModuleTest::QUESTIONS_NUMBER - count($dto->questions),
            'id'              => $id,
        ]);
    }
}