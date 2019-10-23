<?php
namespace App\Domain\Category\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class CategoryAuthValidator extends BaseValidator
{
    /**
     * RegistrationValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'name'          => ['required', 'unique:users'],
            'email'         => 'required|email',
            'password'      => 'required',
            'c_password'    => 'required|same:password',
        ];

        $this->attributes = [
            'name'          => 'name user',
            'email'         => 'email',
            'password'      => 'password',
            'c_password'    => 'confirm password',
        ];

        $this->messages = [
            'name.required'         => trans('validation.required'),
            'email.required'        => trans('validation.required'),
            'password.required'     => trans('validation.required'),
            'c_password.required'   => trans('validation.required'),
        ];
    }
}