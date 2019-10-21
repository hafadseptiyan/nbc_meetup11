<?php

namespace App\Domain\Publisher\Application;

use App\Infrastructure\ErrorHandler;
use App\Domain\Publisher\Entities\Publisher;
use App\Domain\Publisher\Repository\PublisherRepository;
use App\Infrastructure\TransactionManager;

class PublisherManagement
{

	protected $repository;

	public function __construct(PublisherRepository $repository)
	{
		$this->repository = $repository;
	}

	public function call($data, $id = null)
	{
		try {

			$publisher = ($id == null) ? new Publisher() : Publisher::find($id);
			$publisher->name 			= $data['name'];
			$publisher->address 	    = $data['address'];
			$this->repository->store($publisher);

			return ['status' => true, 'data' => $publisher, 'message' => ($id == null) ? 'Data successfully created' : 'Data successfully updated'];	
		} catch (\Exception $e) {
            return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
	}
}