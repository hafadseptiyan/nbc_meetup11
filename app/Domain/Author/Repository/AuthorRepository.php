<?php

namespace App\Domain\Author\Repository;

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
        return Author::with('book')->findOrFail($id);
    }

    public function deleteByAuthorId($id)
    {
        return Author::where('id', $id)->delete();
    }
}