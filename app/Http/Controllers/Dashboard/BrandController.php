<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $brands= Brand::orderBy('id','DESC')->paginate(Pagination_count);
       return view('dashboard.brands.index' ,compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands=Brand::orderBy('id','DESC')->get();
        return view('dashboard.brands.create' , compact('brands'));
    }


public function store(Request $request)
{
   try {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'photo' => 'required_without:id|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Automatically set 'is_active' based on input (default to 0)
        $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);
        //add photo to public folder in project
     /*   $fileName="";
        if($request->has('photo'))
        {
            $fileName=uploadImage('brands' , $request->image);

        } */

        if ($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            $imagePath = $image->store('brands', 'public'); // Stores in storage/app/public/brands
        }


      //  if ($request->has('photo')) {
      //      $imageName = uploadImage('brands', $request->photo);
       //      } else {
              //   return back()->withErrors(['photo' => 'No file was uploaded.']);
        //     }



        // Create category

      $brands=  Brand::create($request->except(['_token','photo']));
      $brands->photo = $imagePath;
      $brands->save();



        return redirect()->route('dashboard.brands.index')->with(['success' => trans('msg.ٍbrandCategoryaddsuccess')]);
    } catch (\Exception $ex) {
        return redirect()->route('dashboard.brands.index')->with(['error' => trans('msg.Somethingwrong')]);
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
