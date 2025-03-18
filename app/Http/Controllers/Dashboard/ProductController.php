<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProductImagesRequest;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->select('id','slug','price','is_active')->paginate(Pagination_count);
      //  dd($products->all());
        return view('dashboard.products.general.index' , compact('products'));
    }
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

  // try {
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
       // Automatically set 'is_active' based on input (default to 0)
    $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);
        // Create product
   // dd( $request->all());
       $product=  Product::create($request->only(['is_active','slug','brand_id','name' ,'description','short_description']));
      // save product categories
      $product->categories()->attach($request->input('categories'));
    // save product tags
    $product->tags()->attach($request->input('tags'));
    $product->save();
   // DB::commit();

        return redirect()->route('dashboard.product.index')->with(['success' => trans('msg.messageadd')]);
  // } catch (\Exception $ex) {
   // DB::rollBack();
        return redirect()->route('dashboard.product.index')->with(['error' => trans('msg.Somethingwrong')]);
  //}


}

// price
public function priceCreate($product_id)
{
    $products=Product::where('id',$product_id)->get();

    return view('dashboard.products.price.create' ,compact('products'))->with('id', $product_id);
}
public function storePrice(Request $request)
{
//    try {
        // Validate input
        $validator = Validator::make($request->all(), [

            'price' => 'required|numeric|min:0',
            'product_id'=>'required|exists:products,id',
            'special_price' => 'nullable|numeric',
            'special_price_start' => 'nullable|required_with:special_price|date',
            'special_price_end' => 'nullable|required_with:special_price|date',
            'special_price_type' => 'nullable|required_with:special_price|in:Fixed,Precent',

        ],

    [
        'special_price_start.required_with'=>trans('msg.special_price_start.required'),
        'special_price_end.required_with'=>trans('msg.special_price_end.required'),
        'special_price_type.required_with'=>trans('msg.special_price.required'),

    ]
);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // update product
   //     DB::beginTransaction();
        $product=  Product::whereId($request->product_id) ->update($request->only(['price','special_price','special_price_type' ,'special_price_start' ,'special_price_end']));
    //    DB::commit();

        return redirect()->route('dashboard.product.index')->with(['success' => trans('msg.messageadd')]);
  //  } catch (\Exception $ex) {
    //    DB::rollBack();
        return redirect()->route('dashboard.product.index')->with(['error' => trans('msg.Somethingwrong')]);
 //   }
}


// stock


    public function stockCreate($product_id)
    {
        $products=Product::where('id',$product_id)->get();
        return view('dashboard.products.stock.create' ,compact('products'))->with('id', $product_id);
    }
    public function stockStore(Request $request)
    {
    try {
        // Validate input
        $validator = Validator::make($request->all(), [
            'sku' => 'required|min:5|max:20',
            'product_id' => 'required|exists:products,id',
            'in_stock' => 'required|in:0,1',
            'manage_stock' => 'required|in:0,1',
            'dty' => 'required_with:manage_stock|integer|min:1',
        ],
        [
            'dty.required_with' => trans('msg.dtyrequiredwith'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // update product
      //  DB::beginTransaction();
        $product=  Product::whereId($request->product_id) ->update($request->only(['sku','in_stock','manage_stock' ,'dty']));
      //  DB::commit();

        return redirect()->route('dashboard.product.index')->with(['success' => trans('msg.messageadd')]);
         } catch (\Exception $ex) {
    //    DB::rollBack();
        return redirect()->route('dashboard.product.index')->with(['error' => trans('msg.Somethingwrong')]);
           }
    }
    /**
     * Display the specified resource.
     */

    // photo
    public function photoCreate($product_id)
    {
        $images = ImageProduct::where('product_id', $product_id)->get();

        return view('dashboard.products.photo.create' ,compact('images'))->with('id', $product_id);
    }
    public function photoStore(Request $request)
    {
       try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate file

            ]);


            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName(); // Generate unique filename
                $path = 'assets/images/imageProduct/'; // Define storage path
                $file->move(public_path($path), $filename); // Move file to public folder

                // Save image in the database
                ImageProduct::create([
                    'product_id' => $request->product_id,
                    'image' => $path . $filename, // Store relative path in the database
                ]);
            }

            return redirect()->route('dashboard.product.index')->with(['success' => trans('msg.messageadd')]);
      } catch (\Exception $ex)
      {
         //   DB::rollBack();
            return redirect()->route('dashboard.product.index')->with(['error' => trans('msg.Somethingwrong')]);
      }
    }


######################################################################3
public function saveProductImages(Request $request)
{
    return $request;

    $file = $request->file('dzfile');
    $filename = uploadImage('Products', $file);

    return response()->json([
        'name' => $filename,
        'original_name' => $file->getClientOriginalName(),
    ]);

}

public function saveProductImagesDB(Request $request)
{
    try {
        // Validate request
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store the image and get the filename
        $file = $request->file('image');
        $filename = uploadImage('Products', $file); // Ensure `uploadImage` properly stores and returns filename

        // Save image in the database
        ImageProduct::create([
            'product_id' => $request->product_id,
            'image' => $filename, // Save the stored image filename
        ]);

        return redirect()->route('dashboard.product.index')->with(['success' => trans('msg.messageadd')]);

    } catch (\Exception $ex) {
        return redirect()->route('dashboard.product.index')->with(['error' => trans('msg.Somethingwrong')]);
    }
}

#################################################333
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
            'photo' => 'required_without:id|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate file
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
