<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options=Option::with('product','attribute')->orderBy('id','desc')->select('id','attribute_id','product_id','price')->paginate(Pagination_count);
        return view('dashboard.options.index',compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=[];
        $data['products']=Product::active()->select('id')->get();
        $data['attributes']=Attribute::select('id')->get();

      /*   $products=Product::select('id')->get();
        $attributes=Attribute::select('id')->get(); */
        return view('dashboard.options.create' , compact('data'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Validate input
            $validator = Validator::make($request->all(), [

                'name' => 'required|min:3|max:100',
                'price' => 'required|numeric|min:3|max:100',

                'product_id'=>'numeric|exists:products,id',

                'attribute_id'=>'numeric|exists:attributes,id',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

           // Create product attribute option
           $option=  Option::create($request->only([ 'price','product_id', 'attribute_id']));
           $option->name=$request->name;

          $option->save();

       // DB::commit();

            return redirect()->route('dashboard.option.index')->with(['success' => trans('msg.messageadd')]);
      } catch (\Exception $ex) {
       // DB::rollBack();
            return redirect()->route('dashboard.option.index')->with(['error' => trans('msg.Somethingwrong')]);
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
    public function edit( $id)
    {
        $option=Option::find($id);
        $data=[];
        $data['products']=Product::active()->select('id')->get();
        $data['attributes']=Attribute::select('id')->get();

        return view('dashboard.options.edit',compact('option','data'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [

                'name' => 'required|min:3|max:100',
                'price' => 'required|numeric|min:3|max:100',
                'product_id'=>'numeric|exists:products,id',
                'attribute_id'=>'numeric|exists:attributes,id',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
           $option=Option::find($id);
           // Create product attribute option
           $option->update($request->only([ 'price','product_id', 'attribute_id']));
           $option->name=$request->name;

          $option->save();

       // DB::commit();

            return redirect()->route('dashboard.option.index')->with(['success' => trans('msg.messageupdate')]);
      } catch (\Exception $ex) {
       // DB::rollBack();
            return redirect()->route('dashboard.option.index')->with(['error' => trans('msg.Somethingwrong')]);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $option=Option::find($id);
            $option->delete();
            return redirect()->route('dashboard.option.index')->with(['success' => trans('msg.messagedelete')]);


        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error'=>trans('msg.Somethingwrong')]);
        }
    }
}
