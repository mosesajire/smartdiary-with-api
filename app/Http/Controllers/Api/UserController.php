<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\ApiRegisterFormRequest;

use App\User;

class UserController extends Controller
{
	// Register new user 
    public function register(ApiRegisterFormRequest $request)
    {
	   	$user = new User;

    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	$token = $user->createToken('SmartDiary')->accessToken;
    	$name = $user->name;

    	$message = 'Registration successful!';

    	return response()->json(['message' => $message, 'name' => $name, 'token' => $token], 200);
        
    }

    // Authenticate user
    public function login(Request $request)
    {
    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	if(auth()->attempt($credentials))
    	{
    		$token = auth()->user()->createToken('SmartDiary')->accessToken;

    		$message = 'Access Granted!';

    		$name = auth()->user()->name;

    		return response()->json(['message' => $message, 'name' => $name, 'token' => $token], 200);
    	} 
    	else
    	{
    		return response()->json(['error' => 'Sorry, something went wrong. Access denied.'], 401);
    	}
    }

    // Get details of user
    public function details()
    {
    	return response()->json(['user' => auth()->user()], 200);
    }
    
}
