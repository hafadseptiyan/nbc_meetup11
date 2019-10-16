<?php

namespace App\Shared;

use Illuminate\Support\Facades\Log;

class ErrorHandler
{
    /**
     * @param $exceptionMessage
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public static function display($exceptionMessage = '')
    {
        Log::error("Error Message", [$exceptionMessage]);
        if (config('app.debug')) {
            return $exceptionMessage;
        }
        return trans('messages.global_error_message');
    }
}
