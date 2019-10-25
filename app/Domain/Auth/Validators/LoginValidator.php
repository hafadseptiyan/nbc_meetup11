<?php
namespace App\Domain\Auth\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class LoginValidator extends BaseValidator
{
    /**
     * LoginValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'email'    => 'required|email',
            'password' => 'required', 
        ];

        $this->attributes = [
            'email'     => 'email of user',
            'password'  => 'password', 
        ];

        $this->messages = [
            'email.required'      => trans('validation.required'),
            'password.required'   => trans('validation.required'),
        ];
    }
}