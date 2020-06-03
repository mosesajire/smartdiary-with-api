<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProfileFormRequest;

use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {

        $user_id = auth()->user()->id;

        return redirect('/profiles/' . $user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(User::find($id))
        {
            if(auth()->user()->id == $id)
            {
                $user = User::find($id);

                return view('profiles.show')->with('user', $user);

            }
            else
            {
                return redirect('/dashboard')->with('error', 'Sorry, something went wrong. Access denied!');
            }
        }
        else
        {
            return redirect('/dashboard')->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(User::find($id))
        {
            if(auth()->user()->id == $id)
            {
                $user = User::find($id);

                return view('profiles.edit')->with('user', $user);

            }
            else
            {
                return redirect('/dashboard')->with('error', 'Sorry, something went wrong. Access denied!');
            }
        }
        else
        {
            return redirect('/dashboard')->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileFormRequest $request, $id)
    {
        if(User::find($id))
        {
            if(auth()->user()->id == $id)
            {
                $user = auth()->user();

                $getEmail = $request->input('email');

                // Prevent user from registering an existing email
                if($user->email != $getEmail)
                {
                    if(User::where('email', $getEmail)->count() == 1)
                    {
                        return redirect('/profiles/' . $id . '/edit')->with('error', 'Sorry, the email is already registered.');
                    }
                    else
                    {
                        $user->email = $request->input('email');
                    }
                }

                $user->name = $request->input('name');

                if(!is_null($request->input('password')))
                {
                    $user->password = bcrypt($request->password);
                }

                $user->save();

                return redirect('/profiles/' . $id)->with('success', 'You have updated your profile successfully.');

            }
            else
            {
                return redirect('/dashboard')->with('error', 'Sorry, something went wrong. Access denied!');
            }

        }
        else
        {
            return redirect('/dashboard/')->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }

}
