<?php

namespace App\Domain\Publisher\Data;

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
        return Publisher::findOrFail($id);
    }

    public function deleteByPublisherId($id)
    {
        return Publisher::where('id', $id)->delete();
    }
}