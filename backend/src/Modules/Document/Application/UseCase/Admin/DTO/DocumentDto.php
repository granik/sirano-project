<?php


namespace App\Modules\Document\Application\UseCase\Admin\DTO;


final class DocumentDto
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var bool
     */
    public $isActive;
    /**
     * @var string
     */
    public $file;
    /**
     * @var \App\Infrastructure\Files\File
     */
    public $fileFile;
}