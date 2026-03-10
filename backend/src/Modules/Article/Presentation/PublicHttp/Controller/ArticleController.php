<?php


namespace App\Modules\Article\Presentation\PublicHttp\Controller;



use App\Modules\Article\Application\UseCase\PublicSite\DTO\ArticleDtoAssembler;
use App\Modules\Direction\Domain\Entity\Category;
use App\Modules\Direction\Domain\Entity\Direction;
use App\Modules\Direction\Domain\Entity\DTO\DirectionDtoAssembler;
use App\Modules\Direction\Application\UseCase\PublicSite\DTO\CategoryDtoAssembler;
use App\Modules\Article\Application\UseCase\PublicSite\ArticleInteractor;
use App\Modules\Direction\Application\UseCase\PublicSite\CategoryInteractor;
use App\Modules\Direction\Application\UseCase\PublicSite\DirectionInteractor;
use App\Modules\Direction\Application\UseCase\PublicSite\FilterDirectionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class ArticleController extends AbstractController
{
    const PER_PAGE = 12;
    
    /**
     * @var ArticleInteractor
     */
    private $interactor;
    /**
     * @var ArticleDtoAssembler
     */
    private $dtoAssembler;
    /**
     * @var FilterDirectionInterface
     */
    private $filterDirection;
    /**
     * @var DirectionInteractor
     */
    private $directionInteractor;
    /**
     * @var CategoryInteractor
     */
    private $categoryInteractor;
    /**
     * @var DirectionDtoAssembler
     */
    private $directionDtoAssembler;
    /**
     * @var CategoryDtoAssembler
     */
    private $categoryDtoAssembler;
    
    /**
     * ArticleController constructor.
     *
     * @param ArticleInteractor        $interactor
     * @param DirectionInteractor      $directionInteractor
     * @param CategoryInteractor       $categoryInteractor
     * @param ArticleDtoAssembler      $dtoAssembler
     * @param DirectionDtoAssembler    $directionDtoAssembler
     * @param CategoryDtoAssembler     $categoryDtoAssembler
     * @param FilterDirectionInterface $filterDirection
     */
    public function __construct(
        ArticleInteractor $interactor,
        DirectionInteractor $directionInteractor,
        CategoryInteractor $categoryInteractor,
        ArticleDtoAssembler $dtoAssembler,
        DirectionDtoAssembler $directionDtoAssembler,
        CategoryDtoAssembler $categoryDtoAssembler,
        FilterDirectionInterface $filterDirection
    ) {
        $this->interactor            = $interactor;
        $this->dtoAssembler          = $dtoAssembler;
        $this->filterDirection       = $filterDirection;
        $this->directionInteractor   = $directionInteractor;
        $this->categoryInteractor    = $categoryInteractor;
        $this->directionDtoAssembler = $directionDtoAssembler;
        $this->categoryDtoAssembler  = $categoryDtoAssembler;
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
            'frontend/article/list.html.twig',
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
}