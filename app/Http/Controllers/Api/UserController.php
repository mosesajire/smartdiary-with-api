<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ApiRegisterFormRequest;

use App\User;

use Validator;

class UserController extends Controller
{
	
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

    public function details()
    {
    	return response()->json(['user' => auth()->user()], 200);
    }
    

    /*
     public function login()
        {
            $credentials = [
                'email' => request('email'), 
                'password' => request('password')
            ];

            if (Auth::attempt($credentials)) {
                $success['token'] = Auth::user()->createToken('SmartDiary')->accessToken;

                return response()->json(['success' => $success]);
            }

            return response()->json(['error' => 'Unauthorised'], 401);
        }

        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);

            $user = User::create($input);
            $success['token'] = $user->createToken('SmartDiary')->accessToken;
            $success['name'] = $user->name;

            return response()->json(['success' => $success]);
        }

        public function details()
        {
            return response()->json(['success' => Auth::user()]);
        }
    */
}
