<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ApiEntryFormRequest;

use App\User;

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
        $entries = auth()->user()->entries;
        return response()->json(
            [
                'success' => true,
                'data' => $entries
            ], 200);
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiEntryFormRequest $request)
    {
        $entry = new Entry;

        $entry->body = $request->body;

        if(auth()->user()->entries()->save($entry))
        {
            return response()->json([
                    'success' => true,
                    'message' => 'Entry created successfully'
                ], 201);
        }
        else
        {
            return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was a problem creating your entry.'
                ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = auth()->user()->entries->find($id);

        if($entry)
        {
            return response()->json(
                [
                    'success' => true,
                    'data' => $entry->toArray()
                ], 200);
        }
        else
        {
            return response()->json([
                    'success' => false,
                    'message' => 'Sorry, entry not found.'
                ], 404);
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entry = auth()->user()->entries->find($id);

        if(!$entry)
        {
            return response()->json([
                    'success' => false,
                    'message' => 'Sorry, entry not found.'
                ], 404);
        }
        else 
        {
            $entry->body = is_null($request->body) ? $entry->body : $request->body;

            if(auth()->user()->entries()->save($entry))
            {
                return response()->json([
                        'success' => true,
                        'message' => 'Entry updated successfully.'
                    ], 200);
            }
            else
            {
                return response()->json([
                        'success' => false,
                        'message' => 'Sorry, there was a problem updating your response'
                    ], 400);
            }
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
        $entry = auth()->user()->entries->find($id);

        if(!$entry)
        {
            return response()->json([
                    'success' => false,
                    'message' => 'Sorry, entry not found.'
                ], 404);
        }
        else
        {
            if($entry->delete())
            {
                return response()->json([
                        'success' => true,
                        'message' => 'Entry deleted successfully'
                    ], 204);
            }
            else
            {
                return response()->json([
                        'success' => false,
                        'message' => 'Sorry, there was a problem deleting your entry.'
                    ], 400);
            }
        }
    }
}
