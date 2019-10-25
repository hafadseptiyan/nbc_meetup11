<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Domain\Auth\Application\AuthManagement;
use App\Domain\Auth\Validators\RegisterValidator;
use App\Domain\Auth\Validators\LoginValidator;
use Illuminate\Support\Facades\Auth; 
use App\Infrastructure\ErrorHandler;
use Validator;

class AuthController extends Controller 
{
	protected $dataManagement;
	
	public function __construct(AuthManagement $dataManagement)
    {
        $this->dataManagement = $dataManagement;
	}
	
	public function index() {
		$user = Auth::user();
		return rest_api(['success' => $user]); 
	}

	 public function register(Request $request, RegisterValidator $validator)
	 {
		$data = $request->all();
		$validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->register($data);
            if($response['status'])
            {
                return rest_api($response['message'] );
            }
            return $this->apiInternalServerErrorResponse([$response['errors']]);
        }
		return $this->apiUnprocessableEntityResponse($validation->all());	 
}
  
   
	public function login(Request $request, LoginValidator $validator)
	{ 
		$data = $request->all();
		$validation = $validator->validate($data);
        if ($validation === true) {
            $response = $this->dataManagement->login($data);
            if($response['status'])
            {
                return rest_api($response['message'] );
            }
            return $this->apiInternalServerErrorResponse([$response['errors']]);
        }
		return $this->apiUnprocessableEntityResponse($validation->all());
	}

	 /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return rest_api('Successfully logged out');
    }		
  
	
} 