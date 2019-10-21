<?php

namespace App\Domain\Publisher\Repository;

use App\Domain\Publisher\Entities\Publisher;

class PublisherRepository
{
    protected $model;

	public function __construct(Publisher $model)
	{
		$this->model = $model;
    }

    public function store(Publisher $model)
	{
		$model->save();
		return $model;
    }
    
    public function findByPublisherId($id)
    {
        return Publisher::with('book')->findOrFail($id);
    }

    public function deleteByPublisherId($id)
    {
        return Publisher::where('id', $id)->delete();
    }
}