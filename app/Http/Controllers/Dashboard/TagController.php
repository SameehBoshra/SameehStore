<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //  dd('show tags ');
       $tags= Tag::orderBy('id','DESC')->paginate(Pagination_count);
       return view('dashboard.tags.index' ,compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // $tags=Tag::orderBy('id','DESC')->get();
        return view('dashboard.tags.create' );
    }


public function store(Request $request)
{
   try {

        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'slug' => 'required|unique:tags,slug,'.$request->id,

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create category

      Tag::create($request->except(['_token']));



        return redirect()->route('dashboard.tags.index')->with(['success' => trans('msg.messageadd')]);
    } catch (\Exception $ex) {
        return redirect()->route('dashboard.tags.index')->with(['error' => trans('msg.Somethingwrong')]);
   }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tags=Tag::orderBy('id','DESC')->find($id);

        return view('dashboard.tags.edit' , compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

      try{
        $valid = [
            'name' => 'required|min:3|max:100' ,
            'slug' => 'required|unique:tags,slug,'.$request->id,
        ];
        $errormsg = [

        ];

        // Validate input
        $validator = Validator::make($request->all(), $valid, $errormsg);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        // Find the admin
        $tags= Tag::orderBy('id','DESC')->find($id);
        if (!$tags) {
            return redirect()->route('dashboard.tags.index')->with(['error' => trans('msg.tagnotfound')]);

        }
        // Update admin details
      $tags->update($request->except(['_token']));
      $tags->save();

        return redirect()->route('dashboard.tags.index')->with(['success' => trans('msg.messageupdate')]);
     }catch(\Exception $ex)
    {
        return redirect()->route('dashboard.tags.index')->with(['error' => trans('msg.Somethingwrong')]);

    }





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $tags =Tag::orderBy('id','DESC')->find($id);
            $tags->delete();

            return redirect()->route('dashboard.tags.index')->with(['success'=>trans('msg.messagedelete')]);
        }catch(\Exception $e)
        {
            return redirect()->route('dashboard.tags.index')->with(['error'=>trans('msg.Somethingwrong')]);

        }



    }
}
