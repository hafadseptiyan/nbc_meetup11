<?php

namespace App\Domain\Category\Data;

use App\Domain\Category\Entities\Category;

class CategoryRepository
{
    public function findByCategoryId($categoryId)
    {
        return Category::findOrFail($categoryId);
    }

    public function deleteByCategoryId($id)
    {
        return Category::where('id', $id)->delete();
    }
}