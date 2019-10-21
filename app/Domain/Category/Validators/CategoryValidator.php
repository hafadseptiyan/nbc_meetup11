<?php
namespace App\Domain\Category\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class CategoryValidator extends BaseValidator
{
    /**
     * RegistrationValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'name'          => ['required', 'unique:categories'],
            'description'   => 'required',
        ];

        $this->attributes = [
            'name'          => 'category',
            'description'   => 'description',
        ];

        $this->messages = [
            'name.required'         => trans('validation.required'),
            'description.required'  => trans('validation.required'),
        ];
    }
}