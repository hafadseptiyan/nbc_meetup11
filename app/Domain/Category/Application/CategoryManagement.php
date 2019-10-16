<?php

namespace App\Domain\Category\Application;

use App\Shared\ErrorHandler;
use App\Domain\Category\Entities\Category;
use App\Shared\TransactionManager;

class CategoryManagement
{

	public function create($data, $id = null)
	{
		try {

			$category = ($id == null) ? new Category() : Category::find($id);
			$category->name 		= $data['name'];
			$category->description 	= $data['description'];
			$category->save();

			return ['status' => true, 'data' => $category, 'message' => ($id == null) ? 'Data successfully created' : 'Data successfully updated'];	
		} catch (\Exception $e) {
            return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
	}
}