<?php


namespace App\Modules\Document\Application\UseCase\PublicSite\DTO;


use App\Modules\Document\Domain\Entity\Document;
use App\Shared\Domain\Service\TextUtils;
use App\Shared\Application\DTO\DtoAssembler;

final class DocumentDtoAssembler extends DtoAssembler
{
    /**
     * @var string
     */
    private $fileUrlPrefix;
    /**
     * @var string
     */
    private $uploadDirectory;
    
    /**
     * ArticleDtoAssembler constructor.
     *
     * @param string $fileUrlPrefix
     * @param string $uploadDirectory
     */
    public function __construct(string $fileUrlPrefix, string $uploadDirectory)
    {
        $this->fileUrlPrefix   = $fileUrlPrefix;
        $this->uploadDirectory = $uploadDirectory;
    }
    
    protected function createDto()
    {
        return new DocumentDto();
    }
    
    /**
     * @param DocumentDto $dto
     * @param Document    $entity
     */
    protected function fill($dto, $entity)
    {
        $dto->name     = $entity->getName();
        $dto->file     = $this->fileUrlPrefix . '/' . $entity->getFile();
    
        $filename = $this->uploadDirectory . '/' . $entity->getFile();
        $filesize = 0;
        if (is_readable($filename)) {
            $filesize = filesize($filename);
        }
    
        $dto->fileSize = TextUtils::russianFriendlyFileSize($filesize);
    }
}