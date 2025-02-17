<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=[];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        return view('dashboard.products.general.create' , compact('data'));
    }


public function store(Request $request)
{
    //dd('request');
  //  return $request;

   //try {
        // Validate input
        $validator = Validator::make($request->all(), [

            'name' => 'required|min:5|max:100',
            'description' => 'required|min:5|max:1000',
            'short_description' => 'nullable|min:5|max:200',
            'slug' => 'required|min:5|max:190|unique:products,slug',
            'categories'=>'required|array|min:1',
            'categories.*'=>'numeric|exists:categories,id',
            'brand_id'=>'required|numeric|exists:brands,id',
            'tags'=>'nullable|array|min:1',
            'tags.*'=>'numeric|exists:tags,id',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

       // return $request;


       // Automatically set 'is_active' based on input (default to 0)
        $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);



        // Create category

      $product=  Product::create($request->except(['_token']));




        return redirect()->back()->with(['success' => trans('msg.ٍbrandCategoryaddsuccess')]);
   // } catch (\Exception $ex) {
        return redirect()->back()->with(['error' => trans('msg.Somethingwrong')]);
 //  }


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
        $brand=Brand::orderBy('id','DESC')->find($id);

        return view('dashboard.brands.edit' , compact('brand'));
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
            'name' => 'required|min:3|max:100' ,
            'photo' => 'required_without:id|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file
        ];
        $errormsg = [

        ];

        // Validate input
        $validator = Validator::make($request->all(), $valid, $errormsg);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            if (Brand::where('id', $request->id)->exists())
            {
                $brands = Brand::find($request->id); // Get brand record
                $imagePath = asset('storage/' . $brands->photo);
            }
            else
            {
                $imagePath = $image->store('brands', 'public'); // Stores in storage/app/public/brands

            }


        }

        // Find the admin
        $brand= Brand::orderBy('id','DESC')->find($id);
        if (!$brand) {
            return redirect()->route('dashboard.barnd.index')->with(['error' => trans('msg.brandnotfound')]);

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
      $brand->update($request->except(['_token' , 'photo']));
      $brand->photo=$imagePath;
      $brand->save();

        return redirect()->route('dashboard.brands.index')->with(['success' => trans('msg.brandupdatesuccess')]);
     }catch(\Exception $ex)
    {
        return redirect()->route('dashboard.brands.index')->with(['error' => trans('msg.Somethingwrong')]);

    }





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $brand =Brand::orderBy('id','DESC')->find($id);
            $brand->delete();

            return redirect()->route('dashboard.brands.index')->with(['success'=>trans('msg.DeletebrandCategorySucessfully')]);
        }catch(\Exception $e)
        {
            return redirect()->route('dashboard.brands.index')->with(['error'=>trans('msg.Somethingwrong')]);

        }



    }
}
