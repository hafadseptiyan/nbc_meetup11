<?php
namespace App\Domain\Author\Services;

use App\Shared\Uploader;

class UploadAuthorImage extends Uploader
{
    protected $fieldName = 'photo';

    public function __construct()
    {
        $this->baseUrl = '';
    }
}