<?php
namespace App\Domain\Publisher\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class PublisherValidator extends BaseValidator
{
    /**
     * RegistrationValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'name'          => ['required', 'unique:publishers'],
            'address'       => 'required',
        ];

        $this->attributes = [
            'name'          => 'name of publsher',
            'address'       => 'address',
        ];

        $this->messages = [
            'name.required'         => trans('validation.required'),
            'address.required'      => trans('validation.required'),
        ];
    }
}