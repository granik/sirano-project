<?php


namespace App\Modules\AdvertBanner\Application\UseCase\PublicSite\DTO;


use App\Modules\AdvertBanner\Domain\Entity\AdvertBanner;
use App\Modules\Banner\Application\UseCase\PublicSite\DTO\BannerDto;
use App\Shared\Application\DTO\DtoAssembler;

final class AdvertBannerDtoAssembler extends DtoAssembler
{
    /**
     * @var string
     */
    private $fileUrlPrefix;
    
    /**
     * ArticleDtoAssembler constructor.
     *
     * @param string $fileUrlPrefix
     */
    public function __construct(string $fileUrlPrefix)
    {
        $this->fileUrlPrefix = $fileUrlPrefix;
    }
    
    protected function createDto()
    {
        return new BannerDto();
    }
    
    /**
     * @param BannerDto    $dto
     * @param AdvertBanner $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->link         = $entity->getLink();
        $dto->desktopImage = $this->fileUrlPrefix . '/' . $entity->getDesktopImage();
        $dto->mobileImage  = $this->fileUrlPrefix . '/' . $entity->getMobileImage();
    }
}