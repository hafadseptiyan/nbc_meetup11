<?php

namespace App\Domain\Category\Data;

use App\Domain\Category\Entities\Category;

class CategoryRepository
{
    protected $model;

	public function __construct(Category $model)
	{
		$this->model = $model;
    }

    public function store(Category $model)
	{
		$model->save();
		return $model;
    }
    
    public function findByCategoryId($id)
    {
        return Category::findOrFail($id);
    }

    public function deleteByCategoryId($id)
    {
        return Category::where('id', $id)->delete();
    }
}