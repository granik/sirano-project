<?php

namespace App\Modules\LearningModule\Application\UseCase\Admin\DTO;


final class ModuleTestDto
{
    /** @var int */
    public $id;
    
    /** @var string Название */
    public $name;
    
    /** @var array Список вопросов */
    public $questions = [];
}