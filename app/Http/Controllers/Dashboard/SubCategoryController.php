<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories= Category::child()->orderBy('id','DESC')->paginate(Pagination_count);
       return view('dashboard.subCategory.index' ,compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::parent()->orderBy('id','DESC')->get();
        return view('dashboard.subCategory.create' , compact('categories'));
    }


public function store(Request $request)
{
    try {
        // Validate input
        $validator = Validator::make($request->all(), [
            'parent_id'=>'required|exists:categories,id',
            'name' => 'required|min:3|max:100',
            'slug' => 'required|unique:categories,slug',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Automatically set 'is_active' based on input (default to 0)
        $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);

        // Create category
        Category::create($request->except(['_token']));

        return redirect()->route('dashboard.Sub.Category.index')->with(['success' => trans('msg.ٍSubCategoryaddsuccess')]);
    } catch (\Exception $ex) {
        return redirect()->route('dashboard.Sub.Category.index')->with(['error' => trans('msg.Somethingwrong')]);
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
        $category=Category::child()->orderBy('id','DESC')->find($id);
        $categories=Category::parent()->orderBy('id','DESC')->get();

        return view('dashboard.subCategory.edit' , compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
      //  return $request;
      //  dd('dfsa');
       // 'parent_id'=>'required|exists:categories,id',
       try{
        $valid = [
            'parent_id'=>'required|exists:categories,id',
            'name' => 'required|min:3|max:100' ,
            'slug' => 'required|unique:categories,slug,'. $request->id,
        ];
        $errormsg = [

        ];

        // Validate input
        $validator = Validator::make($request->all(), $valid, $errormsg);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Find the admin
        $category= Category::orderBy('id','DESC')->find($id);
        if (!$category) {
            return redirect()->route('dashboard.Sub.Category.index')->with(['error' => trans('msg.Categorynotfound')]);

        }
        if(!$request->has('is_active'))
        {
            $request->request->add(['is_active'=>0]);
        }
        else
        {
            $request->request->add(['is_active'=>1]);

        }


        // Update admin details
      $category->update($request->all());
      $category->name=$request['name'];
      $category->save();

        return redirect()->route('dashboard.Sub.Category.index')->with(['success' => trans('msg.SupCategoryupdatesuccess')]);
    }catch(\Exception $ex)
    {
        return redirect()->route('dashboard.Category.index')->with(['error' => trans('msg.Somethingwrong')]);


    }




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $category =Category::orderBy('id','DESC')->find($id);

            return redirect()->route('dashboard.Sub.Category.index')->with(['success'=>trans('msg.DeleteSubCategorySucessfully')]);
        }catch(\Exception $e)
        {
            return redirect()->route('dashboard.Sub.Category.index')->with(['error'=>trans('msg.Somethingwrong')]);

        }



    }
}
