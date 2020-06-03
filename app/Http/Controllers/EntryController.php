<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EntryFormRequest;

use App\Entry;
use App\User;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // User access only their entries only
        $user_id = auth()->user()->id;

        // Old entries
        if(isset($_GET['sort']) && $_GET['sort'] == "asc")
        {
            $entries = Entry::where('user_id', $user_id)->orderBy('id', 'asc')->paginate(10);
        }
        else
        {
            // Recent entries
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
        $user_id = auth()->user()->id;

        $entry = new Entry;

        $entry->body = $request->input('body');
        $entry->user_id = $user_id;

        $entry->save();

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
        if(Entry::find($id))
        {
            $entry = Entry::find($id);

            return view('entries.show', compact('entry'));
        }
        else
        {
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
        if(Entry::find($id))
        {
            $entry = Entry::find($id);

            return view('entries.edit', compact('entry'));
        }
        else
        {
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
                return redirect()->back()->with('error', 'Sorry, something went wrong. Access denied.');
            }
        }
        else
        {
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
