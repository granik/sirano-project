<?php

namespace App\Modules\LearningModule\Domain\Repository\Admin;


use App\Modules\LearningModule\Domain\Entity\ModuleTestQuestion;

interface ModuleTestQuestionRepositoryInterface
{
    public function find($id): ?ModuleTestQuestion;
}