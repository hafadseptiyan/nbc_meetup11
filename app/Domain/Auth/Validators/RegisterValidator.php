<?php
namespace App\Domain\Auth\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class RegisterValidator extends BaseValidator
{
    /**
     * RegistrationValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'name' => 'required',
		    'email' => 'required|email|unique:users',
			'password' => 'required',  
			'c_password' => 'required|same:password', 
        ];

        $this->attributes = [
            'name'          => 'name',
            'email'         => 'email',
            'password'      => 'password', 
            'c_password'    => 'same password', 
        ];

        $this->messages = [
            'name.required'         => trans('validation.required'),
            'email.required'        => trans('validation.required'),
            'password.required'     => trans('validation.required'),
            'c_password.required'   => trans('validation.required'),
        ];
    }
}