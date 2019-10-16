<?php
namespace App\Http\Controllers\API\V1\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Category\Application\CategoryManagement;
use App\Domain\Category\Data\CategoryRepository;
use App\Domain\Category\Services\CategoryDatatable;
use App\Domain\Category\Validators\CategoryValidator;
use App\Domain\Category\Entities\Category;

class CategoryController extends Controller
{
    protected $dataManagement;
    protected $repository;

    public function __construct(CategoryManagement $dataManagement, CategoryRepository $repository)
    {
        $this->dataManagement = $dataManagement;
        $this->repository = $repository;
    }

    public function index()
    {
        $category = Category::all();
        return rest_api($category);;
    }

    public function store(Request $request, CategoryValidator $validator)
    {
        $data = $request->all();
        $validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->create($data);
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
        $category = $this->repository->findByCategoryId($id);
        return rest_api($category );
    }

    public function update($id, Request $request, CategoryValidator $validator)
    {
        $data = $request->all();
        $validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->create($data,$id);
            if($response['status'])
            {
                return rest_api($response['message'] );
            }
            return $this->apiInternalServerErrorResponse([$response['errors']]);
        }
        return $this->apiUnprocessableEntityResponse($validation->all());
    }

    public function destroy($id)
    {
        $this->repository->deleteByCategoryId($id);
        return rest_api('Data is successfully deleted' );
    }
}
