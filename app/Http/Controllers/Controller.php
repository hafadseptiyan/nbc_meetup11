<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     /**
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiUnprocessableEntityResponse($errors = [])
    {
        return apiResponse(422, [
            'errors' => [
                'code' => '002',
                'messages' => $errors
            ]
        ]);
    }


    /**
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiInternalServerErrorResponse($errors = [])
    {
        return apiResponse(500, [
            'errors' => [
                'code' => '000',
                'messages' => $errors
            ]
        ]);
    }
}
