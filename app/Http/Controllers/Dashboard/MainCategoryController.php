<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories= Category::whereNull('parent_id')->orderBy('id','DESC')->paginate(100);
       return view('dashboard.category.index' ,compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }


public function store(Request $request)
{
    try {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'slug' => 'required|unique:categories,slug'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Automatically set 'is_active' based on input (default to 0)
        $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);

        // Create category
        Category::create($request->only(['slug', 'name', 'is_active']));

        return redirect()->route('dashboard.Category.index')->with(['success' => trans('msg.Categoryaddsuccess')]);
    } catch (\Exception $ex) {
        return redirect()->route('dashboard.Category.index')->with(['error' => trans('msg.Somethingwrong')]);
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
        $category=Category::orderBy('id','DESC')->find($id);
        return view('dashboard.category.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        try{
            $valid = [
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
                return redirect()->route('dashboard.Category.index')->with(['error' => trans('msg.Categorynotfound')]);

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

            return redirect()->route('dashboard.Category.index')->with(['success' => trans('msg.Categorysuccess')]);
        }catch(\Exception $ex)
        {
            return redirect()->route('dashboard.Category.index')->with(['error' => trans('msg.Categorynotfound')]);


        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $category =Category::orderBy('id','DESC')->find($id);

            return redirect()->route('dashboard.Category.index')->with(['success'=>trans('msg.DeleteCategorySucessfully')]);
        }catch(\Exception $e)
        {
            return redirect()->route('dashboard.Category.index')->with(['error'=>trans('msg.Somethingwrong')]);

        }



    }
}
