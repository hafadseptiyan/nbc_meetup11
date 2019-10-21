<?php

namespace App\Domain\Author\Application;

use App\Infrastructure\ErrorHandler;
use App\Domain\Author\Entities\Author;
use App\Domain\Author\Repository\AuthorRepository;
use App\Domain\Author\Services\UploadAuthorImage;

class AuthorManagement
{
	protected $repository;
	protected $uploadImageService;

	public function __construct(AuthorRepository $repository, UploadAuthorImage $uploadImageService)
	{
		$this->repository = $repository;
		$this->uploadImageService = $uploadImageService;
	}

	public function call($data, $id = null)
	{
		try {

			$author = ($id == null) ? new Author() : Author::find($id);
			$author = $this->defineBaseInformation($author, $data);
			$create = $this->repository->store($author);
			if($data['photo']) $this->saveGalleries($create, $data);

			return ['status' => true, 'data' => $author, 'message' => ($id == null) ? 'Data successfully created' : 'Data successfully updated'];	
		} catch (\Exception $e) {
            return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
	}

	protected function defineBaseInformation($author, $data)
	{	
		$author->name       	= $data['name'];
		if($data['photo'])
		{	
			$author->photo = ''; 
		}
        $author->bio       		= $data['bio'];

		return $author;
	}

	protected function saveGalleries($author, $data)
	{
		$order = 1;

			$this->uploadImageService->order = $order;
			$photo = asset('/storage').'/'.$this->uploadImageService->upload(['photo' => $data['photo']] );

			if( $order == 1) $cover = $photo;

			$author->where('id',$author->id)->update(['photo' => $photo]);

		return $this;
	}
}