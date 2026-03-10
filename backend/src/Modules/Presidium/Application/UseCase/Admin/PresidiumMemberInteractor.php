<?php


namespace App\Modules\Presidium\Application\UseCase\Admin;

use App\Infrastructure\Files\FileUploader;

use App\Modules\Direction\Application\UseCase\Admin\DirectionInteractor;

use App\Modules\Platform\Application\UseCase\Admin\DeleteInteractor;


use App\Modules\Presidium\Application\UseCase\Admin\DTO\PresidiumMemberDto;
use App\Modules\Presidium\Domain\Repository\Admin\PresidiumMemberRepositoryInterface;
use App\Modules\Presidium\Domain\Entity\PresidiumMember;
use App\Shared\Application\Port\NonExistentEntity;

final class PresidiumMemberInteractor
{
    use DeleteInteractor;
    
    const UPLOAD_DIRECTORY = 'presidium';
    
    /**
     * @var PresidiumMemberRepositoryInterface
     */
    private $repository;
    /**
     * @var DirectionInteractor
     */
    private $directionInteractor;
    /**
     * @var FileUploader
     */
    private $fileUploader;
    
    /**
     * PresidiumMemberInteractor constructor.
     *
     * @param PresidiumMemberRepositoryInterface $repository
     * @param DirectionInteractor                $directionInteractor
     * @param FileUploader                       $fileUploader
     */
    public function __construct(
        PresidiumMemberRepositoryInterface $repository,
        DirectionInteractor $directionInteractor,
        FileUploader $fileUploader
    ) {
        $this->repository          = $repository;
        $this->directionInteractor = $directionInteractor;
        $this->fileUploader        = $fileUploader;
    }
    
    public function list(int $page, int $perPage)
    {
        return $this->repository->list($page, $perPage);
    }
    
    public function create(PresidiumMemberDto $dto)
    {
        $entity = new PresidiumMember();
        $entity = $this->fillEntity($entity, $dto);
        
        $this->repository->store($entity);
        
        $this->fillEntityImages($entity, $dto);
        
        $this->repository->update($entity);
        
        return $entity;
    }
    
    public function find($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * @param $dto
     *
     * @return mixed
     * @throws NonExistentEntity
     */
    public function update($dto)
    {
        $entity = $this->find($dto->id);
        
        if (!$entity instanceof PresidiumMember) {
            throw new NonExistentEntity();
        }
        
        $entity = $this->fillEntity($entity, $dto);
        $this->fillEntityImages($entity, $dto);
        
        return $this->repository->update($entity);
    }
    
    /**
     * @param PresidiumMember    $entity
     * @param PresidiumMemberDto $dto
     *
     * @return PresidiumMember
     */
    private function fillEntity(PresidiumMember $entity, PresidiumMemberDto $dto): PresidiumMember
    {
        $entity
            ->setName($dto->name)
            ->setMiddlename($dto->middlename)
            ->setLastname($dto->lastname)
            ->setDescription($dto->description)
            ->setIsActive($dto->isActive)
            ->setNumber($dto->number);
        
        return $entity;
    }
    
    /**
     * @param PresidiumMember    $entity
     * @param PresidiumMemberDto $dto
     *
     * @return PresidiumMemberInteractor
     * @throws Exceptions\NoUploadFile
     */
    private function fillEntityImages(PresidiumMember $entity, PresidiumMemberDto $dto): PresidiumMemberInteractor
    {
        if (
            $dto->imageFile instanceof File
            && $dto->imageFile->getUploadedFile() instanceof UploadedFile
        ) {
            $entity->setImage(
                $this->fileUploader->upload(
                    $dto->imageFile,
                    'photo',
                    self::UPLOAD_DIRECTORY . '/' . $entity->getId()
                )
            );
        }
        
        return $this;
    }
}