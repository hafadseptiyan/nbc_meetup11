<?php
namespace App\Infrastructure;

use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{
    /**
     * Default rules
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Default messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * custom attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * @param array $request
     * @return bool
     */
    public function validate($request = [])
    {
        $validation = Validator::make($request, $this->rules, $this->messages, $this->attributes);
        if ($validation->passes()) {
            return true;
        }
        return $validation->errors();
    }
}
