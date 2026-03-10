<?php

namespace App\Modules\LearningModule\Presentation\PublicHttp\Controller;



use App\Modules\ClinicalAnalysis\Domain\Entity\ClinicalAnalysis;
use App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\DTO\ClinicalAnalysisDtoAssembler;
use App\Modules\Direction\Domain\Entity\Category;
use App\Modules\Direction\Domain\Entity\Direction;
use App\Modules\Direction\Domain\Entity\DTO\DirectionDtoAssembler;
use App\Modules\Direction\Application\UseCase\PublicSite\DTO\CategoryDtoAssembler;
use App\Modules\LearningModule\Application\UseCase\PublicSite\DTO\ModuleDtoAssembler;
use App\Modules\LearningModule\Application\UseCase\PublicSite\DTO\ModuleTestDtoAssembler;
use App\Modules\LearningModule\Domain\Entity\Module;
use App\Modules\LearningModule\Domain\Entity\ModuleTest;
use App\Modules\Direction\Application\UseCase\PublicSite\CategoryInteractor;
use App\Modules\ClinicalAnalysis\Application\UseCase\PublicSite\ClinicalAnalysisInteractor;
use App\Modules\Direction\Application\UseCase\PublicSite\DirectionInteractor;
use App\Shared\Domain\Exception\TestResultAlreadyExists;
use App\Shared\Domain\Exception\UserIsNotCustomer;
use App\Modules\Direction\Application\UseCase\PublicSite\FilterDirectionInterface;
use App\Modules\LearningModule\Application\UseCase\PublicSite\ModuleInteractor;
use App\Modules\LearningModule\Application\UseCase\PublicSite\ModuleTestInteractor;
use App\Infrastructure\Security\SymfonyUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class ModuleController extends AbstractController
{
    const PER_PAGE = 12;
    
    /**
     * @var ModuleInteractor
     */
    private $interactor;
    /**
     * @var ModuleDtoAssembler
     */
    private $dtoAssembler;
    /**
     * @var ModuleTestDtoAssembler
     */
    private $testDtoAssembler;
    /**
     * @var ModuleTestInteractor
     */
    private $testInteractor;
    /**
     * @var FilterDirectionInterface
     */
    private $filterDirection;
    /**
     * @var ClinicalAnalysisInteractor
     */
    private $clinicalAnalysisInteractor;
    /**
     * @var ClinicalAnalysisDtoAssembler
     */
    private $clinicalAnalysisDtoAssembler;
    /**
     * @var DirectionInteractor
     */
    private $directionInteractor;
    /**
     * @var DirectionDtoAssembler
     */
    private $directionDtoAssembler;
    /**
     * @var CategoryInteractor
     */
    private $categoryInteractor;
    /**
     * @var CategoryDtoAssembler
     */
    private $categoryDtoAssembler;
    
    /**
     * ModuleController constructor.
     *
     * @param ModuleInteractor             $interactor
     * @param ModuleTestInteractor         $testInteractor
     * @param ClinicalAnalysisInteractor   $clinicalAnalysisInteractor
     * @param DirectionInteractor          $directionInteractor
     * @param CategoryInteractor           $categoryInteractor
     * @param ModuleDtoAssembler           $dtoAssembler
     * @param ModuleTestDtoAssembler       $testDtoAssembler
     * @param ClinicalAnalysisDtoAssembler $clinicalAnalysisDtoAssembler
     * @param DirectionDtoAssembler        $directionDtoAssembler
     * @param CategoryDtoAssembler         $categoryDtoAssembler
     * @param FilterDirectionInterface     $filterDirection
     */
    public function __construct(
        ModuleInteractor $interactor,
        ModuleTestInteractor $testInteractor,
        ClinicalAnalysisInteractor $clinicalAnalysisInteractor,
        DirectionInteractor $directionInteractor,
        CategoryInteractor $categoryInteractor,
        ModuleDtoAssembler $dtoAssembler,
        ModuleTestDtoAssembler $testDtoAssembler,
        ClinicalAnalysisDtoAssembler $clinicalAnalysisDtoAssembler,
        DirectionDtoAssembler $directionDtoAssembler,
        CategoryDtoAssembler $categoryDtoAssembler,
        FilterDirectionInterface $filterDirection
    ) {
        $this->interactor                   = $interactor;
        $this->testInteractor               = $testInteractor;
        $this->dtoAssembler                 = $dtoAssembler;
        $this->testDtoAssembler             = $testDtoAssembler;
        $this->filterDirection              = $filterDirection;
        $this->clinicalAnalysisInteractor   = $clinicalAnalysisInteractor;
        $this->clinicalAnalysisDtoAssembler = $clinicalAnalysisDtoAssembler;
        $this->directionInteractor          = $directionInteractor;
        $this->directionDtoAssembler        = $directionDtoAssembler;
        $this->categoryInteractor           = $categoryInteractor;
        $this->categoryDtoAssembler         = $categoryDtoAssembler;
    }
    
    public function index(Request $request)
    {
        $page  = $request->query->get('page', 1);
        $limit = $request->query->get('limit', self::PER_PAGE);
        
        $filterDirection   = $this->filterDirection->getSelectedDirection();
        $selectedDirection = null;
        if ($filterDirection instanceof Direction) {
            $selectedDirection = $filterDirection;
        } else {
            $directionId = $request->query->get('direction');
            
            if ($directionId !== null) {
                $selectedDirection = $this->directionInteractor->find($directionId);
            }
        }
        
        $categoryId       = $request->query->get('category');
        $selectedCategory = null;
        if ($categoryId !== null) {
            $selectedCategory = $this->categoryInteractor->find($categoryId);
        }
        
        $list     = $this->interactor->list($page, $limit, $selectedDirection, $selectedCategory);
        $entities = $this->dtoAssembler->assembleList($list);
        
        $directions = $this->directionDtoAssembler->assembleList($this->directionInteractor->activeList());
        
        $selectedDirectionDto = null;
        $categories           = [];
        if ($selectedDirection instanceof Direction) {
            $selectedDirectionDto = $this->directionDtoAssembler->assemble($selectedDirection);
            $categories           = $selectedDirection->getCategories();
        }
        
        $categoryDtos = $this->categoryDtoAssembler->assembleList($categories);
        
        $selectedCategoryDto = null;
        if ($selectedCategory instanceof Category) {
            $selectedCategoryDto = $this->categoryDtoAssembler->assemble($selectedCategory);
        }
        
        $pages = ceil($list->count() / $limit);
        
        return $this->render(
            'frontend/module/list.html.twig',
            [
                'list'              => $entities,
                'page'              => $page,
                'pages'             => $pages,
                'limit'             => $limit,
                'directions'        => $directions,
                'selectedDirection' => $selectedDirectionDto,
                'category'          => $categoryDtos,
                'selectedCategory'  => $selectedCategoryDto,
            ]
        );
    }
    
    public function show($id)
    {
        $entity = $this->interactor->find($id);
        
        if (!$entity instanceof Module) {
            throw $this->createNotFoundException('Нет такого модуля');
        }
        
        $clinicalAnalysis    = $this->clinicalAnalysisInteractor->findByModule($entity);
        $clinicalAnalysisDto = null;
        
        if ($clinicalAnalysis instanceof ClinicalAnalysis) {
            $clinicalAnalysisDto = $this->clinicalAnalysisDtoAssembler->assemble($clinicalAnalysis);
        }
        
        $dto = $this->dtoAssembler->assemble($entity);
        
        return $this->render(
            'frontend/module/show.html.twig',
            [
                'entity'              => $dto,
                'clinicalAnalysisDto' => $clinicalAnalysisDto,
            ]
        );
    }
    
    public function test($id)
    {
        $module = $this->interactor->find($id);
        
        if (!$module instanceof Module) {
            throw $this->createNotFoundException('Нет такого модуля');
        }
        
        $entity = $this->interactor->getTest($module);
        
        if (!$entity instanceof ModuleTest) {
            throw $this->createNotFoundException('Нет такого теста');
        }
        
        $dto = $this->testDtoAssembler->assemble($entity);
        
        return $this->render(
            'frontend/module/test.html.twig',
            [
                'entity' => $dto,
            ]
        );
    }
    
    public function checkTest(Request $request)
    {
        if (!$request->request->has('id') || !$request->request->has('correct')) {
            return $this->json([
                'status' => 'error',
                'error'  => 'required parameter missing',
            ]);
        }
        
        $id     = $request->request->get('id');
        $entity = $this->testInteractor->find($id);
        
        if (!$entity instanceof ModuleTest) {
            return $this->json([
                'status' => 'error',
                'error'  => 'module test not found'
            ]);
        }
        
        /** @var SymfonyUser $symfonyUser */
        $symfonyUser         = $this->getUser();
        $correctAnswerNumber = $request->request->get('correct');
    
        try {
            $this->testInteractor->checkTest($entity, $correctAnswerNumber, $symfonyUser->getUser());
        } catch (TestResultAlreadyExists $e) {
            return $this->json([
                'status' => 'error',
                'error'  => 'test result already exists'
            ]);
        } catch (UserIsNotCustomer $e) {
            return $this->json([
                'status' => 'error',
                'error'  => 'user is not customer'
            ]);
        }
    
        return $this->json(['status' => 'ok']);
    }
    
    public function profile(Request $request)
    {
        $symfonyUser = $this->getUser();
        $user        = $symfonyUser->getUser();
        $page        = $request->query->get('page', 1);
        $limit       = $request->query->get('limit', self::PER_PAGE);
        
        $list     = $this->interactor->getProfileModules($user, $page, $limit);
        $webinars = $this->dtoAssembler->assembleList($list);
        
        $pages = ceil($list->count() / $limit);
        
        return $this->render(
            'frontend/profile/module.html.twig',
            [
                'list'  => $webinars,
                'page'  => $page,
                'pages' => $pages,
                'limit' => $limit,
            ]
        );
    }
}