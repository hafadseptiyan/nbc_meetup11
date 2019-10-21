<?php
namespace App\Domain\Book\Services;

use App\Infrastructure\Uploader;

class UploadBookImage extends Uploader
{
    protected $fieldName = 'cover';

    public function __construct()
    {
        $this->baseUrl = '';
    }
}