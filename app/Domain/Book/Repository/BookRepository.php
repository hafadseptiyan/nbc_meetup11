<?php

namespace App\Domain\Book\Repository;

use App\Domain\Book\Entities\Book;

class BookRepository
{
    protected $model;

	public function __construct(Book $model)
	{
		$this->model = $model;
    }

    public function store(Book $model)
	{
		$model->save();
		return $model;
	}
    
    public function findByBookId($id)
    {
        return Book::findOrFail($id);
    }

    public function deleteByBookId($id)
    {
        return Book::where('id', $id)->delete();
    }
}