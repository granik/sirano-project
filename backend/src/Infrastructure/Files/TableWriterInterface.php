<?php


namespace App\Infrastructure\Files;


interface TableWriterInterface
{
    public function write(array $report);
}