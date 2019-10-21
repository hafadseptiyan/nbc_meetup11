<?php
namespace App\Http\Controllers\API\V1\Publisher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Publisher\Application\PublisherManagement;
use App\Domain\Publisher\Repository\PublisherRepository;
use App\Domain\Publisher\Validators\PublisherValidator;
use App\Domain\Publisher\Entities\Publisher;

class PublisherController extends Controller
{
    protected $dataManagement;
    protected $repository;

    public function __construct(PublisherManagement $dataManagement, PublisherRepository $repository)
    {
        $this->dataManagement = $dataManagement;
        $this->repository = $repository;
    }

    public function index()
    {
        $publisher = Publisher::with('book')->get();
        return rest_api($publisher);
    }

    public function store(Request $request, PublisherValidator $validator)
    {
        $data = $request->all();
        $validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->call($data);
            if($response['status'])
            {
                return rest_api($response['message'] );
            }
            return $this->apiInternalServerErrorResponse([$response['errors']]);
        }
        return $this->apiUnprocessableEntityResponse($validation->all());
    }

    public function show($id)
    {
        $publisher = $this->repository->findByPublisherId($id);
        return rest_api($publisher);
    }

    public function update($id, Request $request, PublisherValidator $validator)
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
        $this->repository->deleteByPublisherId($id);
        return rest_api('Data is successfully deleted');
    }
}
