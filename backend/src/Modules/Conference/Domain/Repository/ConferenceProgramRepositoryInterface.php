<?php

namespace App\Modules\Conference\Domain\Repository;

use App\Modules\Conference\Domain\Entity\Conference;


interface ConferenceProgramRepositoryInterface
{
    public function deleteConferencePrograms(Conference $conference);
    
    public function addConferencePrograms(Conference $conference, array $programs);
}