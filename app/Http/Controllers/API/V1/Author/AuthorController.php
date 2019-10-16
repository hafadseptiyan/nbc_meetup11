<?php
namespace App\Http\Controllers\API\V1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Author\Application\AuthorManagement;
use App\Domain\Author\Data\AuthorRepository;
use App\Domain\Author\Services\AuthorDatatable;
use App\Domain\Author\Validators\AuthorValidator;
use App\Domain\Author\Entities\Author;

class AuthorController extends Controller
{
    protected $dataManagement;
    protected $repository;

    public function __construct(AuthorManagement $dataManagement, AuthorRepository $repository)
    {
        $this->dataManagement = $dataManagement;
        $this->repository = $repository;
    }

    public function index()
    {
        $author = Author::all();
        return rest_api($author);
    }

    public function store(Request $request, AuthorValidator $validator)
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
        $author = $this->repository->findByAuthorId($id);
        return rest_api($author);
    }

    public function update($id, Request $request, AuthorValidator $validator)
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
        $this->repository->deleteByAuthorId($id);
        return rest_api('Data is successfully deleted');
    }
}
