<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EntryFormRequest;

use App\Entry;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get id of user: User can access only their entries
        $user_id = auth()->user()->id;

        // Old entries: display ten results per page 
        if(isset($_GET['sort']) && $_GET['sort'] == "asc")
        {
            $entries = Entry::where('user_id', $user_id)->orderBy('id', 'asc')->paginate(10);
        }
        else
        {
        // Recent entries: display ten results per page
            $entries = Entry::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(10);
        }

        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntryFormRequest $request)
    {
        // Get the id of the user
        $user_id = auth()->user()->id;

        // Create a new object
        $entry = new Entry;

        // Retrieve user's input
        $entry->body = $request->input('body');
        $entry->user_id = $user_id;

        // Save user's input
        $entry->save();

        // Redirect to the entries page
        return redirect('/entries')->with('success', 'You have created a new entry successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get id of user: User can access only their entries
        $user_id = auth()->user()->id;

        // Confirm that the entry exists
        if(Entry::where('id', $id)->where('user_id', $user_id)->first())
        {
            $entry = Entry::where('id', $id)->where('user_id', $user_id)->first();

            return view('entries.show', compact('entry'));
        }
        else 
        {
            // If the entry does not exist, display error message
            return redirect()->back()->with('error', 'Sorry, something went wrong. We could not find that entry.');
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
        // Get id of user: User can access only their entries
        $user_id = auth()->user()->id;

        // Confirm that the entry exists
        if(Entry::where('id', $id)->where('user_id', $user_id)->first())
        {
            $entry = Entry::where('id', $id)->where('user_id', $user_id)->first();

            return view('entries.edit', compact('entry'));
        }
        else 
        {
            // If the entry does not exist, display error message
            return redirect()->back()->with('error', 'Sorry, something went wrong. We could not find that entry.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EntryFormRequest $request, $id)
    {
        // Confirm that the entry exists
        if(Entry::find($id))
        {
            $entry = Entry::find($id);

            // User can edit only their own entries
            if($entry->user_id == auth()->user()->id)
            {

                $entry->body = is_null($request->input('body')) ? $entry->body : $request->input('body');

                $entry->save();

                return redirect('/entries')->with('success', 'You have updated an entry successfully.');
            }
            else 
            {
                // If entry author is not the current user, display error
                return redirect()->back()->with('error', 'Sorry, something went wrong. Access denied.');
            }
        }
        else 
        {
            // If the entry does not exist, display error message
            return redirect()->back()->with('error', 'Sorry, something went wrong. We could not find that entry.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entry::find($id))
        {
            $entry = Entry::find($id);

            // User can delete only their own entries
            if($entry->user_id == auth()->user()->id)
            {
                $entry->delete();

                return redirect('/entries')->with('success', 'You have deleted an entry successfully.');
            }
            else
            {
                return redirect()->back()->with('error', 'Sorry, something went wrong. Access denied.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Sorry, something went wrong. We could not find that entry.');
        }
    }
}
