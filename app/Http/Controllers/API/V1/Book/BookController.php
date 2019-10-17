<?php
namespace App\Http\Controllers\API\V1\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Book\Application\BookManagement;
use App\Domain\Book\Data\BookRepository;
use App\Domain\Book\Validators\BookValidator;
use App\Domain\Book\Entities\Book;

class BookController extends Controller
{
    protected $dataManagement;
    protected $repository;

    public function __construct(BookManagement $dataManagement, BookRepository $repository)
    {
        $this->dataManagement = $dataManagement;
        $this->repository = $repository;
    }

    public function index()
    {
        $book = Book::with('category','author','publisher')->paginate(10);
        return rest_api($book);
    }

    public function store(Request $request, BookValidator $validator)
    {
        $data = $request->all();
        $validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->call($data);
            if($response['status'])
            {
                return rest_api($response['message']);
            }
            return $this->apiInternalServerErrorResponse([$response['errors']]);
        }
        return $this->apiUnprocessableEntityResponse($validation->all());
    }

    public function show($id)
    {
        $book = $this->repository->findByBookId($id);
        return rest_api($book);
    }

    public function update($id, Request $request, BookValidator $validator)
    {
        $data = $request->all();
        $validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->call($data,$id);
            if($response['status'])
            {
                return rest_api($response['message']);
            }
            return $this->apiInternalServerErrorResponse([$response['errors']]);
        }
        return $this->apiUnprocessableEntityResponse($validation->all());
    }

    public function destroy($id)
    {
        $this->repository->deleteByBookId($id);
        return rest_api('Data is successfully deleted');
    }
}
