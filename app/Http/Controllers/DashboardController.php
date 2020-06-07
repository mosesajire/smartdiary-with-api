<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entry;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the id of user
        $user_id = auth()->user()->id;

        // Get total number of entries for the user
        $getCount = Entry::where('user_id', $user_id)->count();

        // Go to the dashboard view
        return view('dashboard', compact('getCount'));
    }
}
