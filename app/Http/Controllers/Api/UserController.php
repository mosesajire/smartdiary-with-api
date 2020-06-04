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
    }
}
