<?php


namespace App\Modules\Platform\Application\UseCase\Admin;


use App\Shared\Application\Port\NonExistentEntity;

trait DeleteInteractor
{
    /**
     * @param $id
     *
     * @throws NonExistentEntity
     */
    public function delete($id)
    {
        $entity = $this->find($id);
        
        if ($entity === null) {
            throw new NonExistentEntity();
        }
        
        $this->repository->delete($entity);
    }
}