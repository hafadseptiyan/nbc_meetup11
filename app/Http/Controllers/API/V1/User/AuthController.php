<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Infrastructure\ErrorHandler;

class AuthController extends Controller 
{

	public function index() {
		$user = Auth::user();
		return rest_api(['success' => $user]); 
	}

	 public function register(Request $request)
	 {
		 try {    
			 $validator = Validator::make($request->all(), 
			              [ 
			              'name' => 'required',
			              'email' => 'required|email|unique:users',
			              'password' => 'required',  
			              'c_password' => 'required|same:password', 
			             ]);   
			 if ($validator->fails()) {          
			       return rest_error(['errors'=>$validator->errors()]);    
			                           }    
			 $input = $request->all();  
			 $input['password'] = bcrypt($input['password']);
			 $user = User::create($input); 
			 $success['token'] =  $user->createToken('AppName')->accessToken;
			 return rest_api(['success'=>$success]); 

		} catch (\Exception $e) {
	      return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}		 
}
  
   
	public function login(Request $request)
	{ 
		try {    
			$validator = Validator::make($request->all(), 
			              [ 
			              'email' => 'required|email',
			              'password' => 'required',  
			             ]);   
			 if ($validator->fails()) {          
			       return rest_error(['errors'=>$validator->errors()]);    
			 }
			if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
			   $user = Auth::user(); 
			   $success['token'] =  $user->createToken('AppName')-> accessToken; 
			    return rest_api(['success' => $success]); 
			  } else{ 
			   return rest_api(['errors'=>'Unauthorized'], 401); 
			}
		
		} catch (\Exception $e) {
	      return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
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