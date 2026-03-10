<?php

namespace App\Shared\Application\Port;


interface FileUploaderInterface
{
    public function upload($icon, string $string, string $directory = ''): string;
}