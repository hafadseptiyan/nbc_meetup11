<?php

namespace App\Domain\Auth\Application;

use App\Infrastructure\ErrorHandler;
use App\Domain\Auth\Entities\User;
use Illuminate\Support\Facades\Auth; 

class AuthManagement
{
	public function register($data)
	{
		try {

			$data['password'] = bcrypt($data['password']);
			$user = User::create($data);
			
			return ['status' => true, 'data' => $user, 'message' => 'Register account success'];	
		} catch (\Exception $e) {
            return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
	}

	public function login($data)
	{
		try {
			
		   if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){ 
			 $user = Auth::user(); 
			 $success['user']  =  Auth::user(); 
			 $success['token'] =  $user->createToken('AppName')->accessToken;
			}
			return ['status' => true, 'data' => $user, 'message' => $success];	
		} catch (\Exception $e) {
            return ['status' => false, 'errors' => [ErrorHandler::display($e->getMessage())]];
		}
	}
}