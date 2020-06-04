<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ApiRegisterFormRequest;

use User;

class UserController extends Controller
{
    public function register(ApiRegisterFormRequest $request)
    {
    	$user = new User;

    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);

    	$token = $user->createToken('SmartDiary')->accessToken;

    	return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	if(auth()->attempt($credentials))
    	{
    		$token = auth()->user()->createToken('SmartDiary')->accessToken;
    		return response()->json(['token' => $token], 200);
    	} 
    	else
    	{
    		return response()->json(['error' => 'Sorry, you are not authorized to perform this action.'], 401);
    	}
    }

    public function details()
    {
    	return response()->json(['user' => auth()->user()], 200);
    }
}
