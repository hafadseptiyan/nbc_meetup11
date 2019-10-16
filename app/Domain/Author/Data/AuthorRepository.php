<?php

namespace App\Domain\Author\Data;

use App\Domain\Author\Entities\Author;

class AuthorRepository
{
    protected $model;

	public function __construct(Author $model)
	{
		$this->model = $model;
    }

    public function store(Author $model)
	{
		$model->save();
		return $model;
	}
    
    public function findByAuthorId($id)
    {
        return Author::findOrFail($id);
    }

    public function deleteByAuthorId($id)
    {
        return Author::where('id', $id)->delete();
    }
}