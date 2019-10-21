<?php

namespace App\Infrastructure;

use Symfony\Component\HttpFoundation\File\Exception\UploadException;

abstract class Uploader
{
    /**
     * @var String
     */
    protected $fieldName;

    /**
     * @var String
     */
    protected $baseUrl = null;

    /**
     * @var integer
     */
    public $order = 1;

    /**
     * @param $data
     * @return null|string
     */
    public function upload($data)
    {
        $imageName = null;
        if (!empty($data[$this->fieldName])) {
            try {
                $extension = $data[$this->fieldName]->getClientOriginalExtension();
                $imageName = $this->fieldName.$this->order.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$extension;
                //$data[$this->fieldName]->storeAs('public'.$this->baseUrl, $imageName);
                $data[$this->fieldName]->move(storage_path('app/public'), $imageName);
            } catch (UploadException $e) {
                throw new UploadException($e->getMessage());
            }
        }
        return $imageName;
    }

    /**
     * @return String
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
