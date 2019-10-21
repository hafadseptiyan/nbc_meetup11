<?php

namespace App\Domain\Book\Application;

use App\Infrastructure\ErrorHandler;
use App\Domain\Book\Entities\Book;
use App\Domain\Book\Repository\BookRepository;
use App\Domain\Book\Services\UploadBookImage;

class BookManagement
{
	protected $repository;
	protected $uploadImageService;

	public function __construct(BookRepository $repository, UploadBookImage $uploadImageService)
	{
		$this->repository = $repository;
		$this->uploadImageService = $uploadImageService;
	}

	public function call($data, $id = null)
	{
		try {

			$book = ($id == null) ? new Book() : Book::find($id);
			$book = $this->defineBaseInformation($book, $data);
			$create = $this->repository->store($book);
			if($data['cover']) $this->saveGalleries($create, $data);

			return ['status' => true, 'data' => $book, 'message' => ($id == null) ? 'Data successfully created' : 'Data successfully updated'];	
		} catch (\Exception $e) {
            return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
	}

	protected function defineBaseInformation($book, $data)
	{	
		$book->name       		= $data['name'];
		if($data['cover'])
		{	
			$book->cover 		= ''; 
		}
        $book->description 		= $data['description'];
        $book->published_year 	= $data['published_year'];
        $book->category_id 		= $data['category_id'];
        $book->author_id 		= $data['author_id'];
        $book->publisher_id 	= $data['publisher_id'];

		return $book;
	}

	protected function saveGalleries($book, $data)
	{
		$order = 1;

			$this->uploadImageService->order = $order;
			$cover = asset('/storage/book').'/'.$this->uploadImageService->upload(['cover' => $data['cover']] );

			if( $order == 1) $cover = $cover;

			$book->where('id',$book->id)->update(['cover' => $cover]);

		return $this;
	}
}