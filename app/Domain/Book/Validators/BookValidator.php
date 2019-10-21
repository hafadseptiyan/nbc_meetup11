<?php
namespace App\Domain\Book\Validators;

use App\Infrastructure\BaseValidator;
use Illuminate\Validation\Rule;

class BookValidator extends BaseValidator
{
    /**
     * RegistrationValidator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'cover'             => 'mimes:jpg,jpeg,png',
            'name'              => ['required', 'unique:books'],
            'description'       => 'required',
            'published_year'    => 'required',
            'category_id'       => 'required',
            'author_id'         => 'required',
            'publisher_id'      => 'required',
        ];

        $this->attributes = [
            'name'              => 'name of book',
            'cover'             => 'cover',
            'description'       => 'description',
            'published_year'    => 'published_year',
            'category_id'       => 'category',
            'author_id'         => 'author',
            'publisher_id'      => 'publisher',
        ];

        $this->messages = [
            'name.required'             => trans('validation.required'),
            'cover.required'            => trans('validation.required'),
            'description.required'      => trans('validation.required'),
            'published_year.required'   => trans('validation.required'),
            'category_id.required'      => trans('validation.required'),
            'author_id.required'        => trans('validation.required'),
            'publisher_id.required'     => trans('validation.required'),
        ];
    }
}