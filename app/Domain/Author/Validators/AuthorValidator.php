<?php
namespace App\Domain\Author\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class AuthorValidator extends BaseValidator
{
    /**
     * RegistrationValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'name'          => ['required', 'unique:authors'],
            'photo'         => 'mimes:jpg,jpeg,png',
            'bio'           => 'required',
        ];

        $this->attributes = [
            'name'          => 'name of author',
            'photo'         => 'photo',
            'bio'           => 'biodata',
        ];

        $this->messages = [
            'name.required'         => trans('validation.required'),
            'bio.required'          => trans('validation.required'),
        ];
    }
}