<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attribute as ModelsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes=ModelsAttribute::orderBy('id','desc')->paginate(Pagination_count);
        return view('dashboard.attributes.index' ,compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes=ModelsAttribute::orderBy('id','desc')->get();
        return view('dashboard.attributes.create' ,compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try{
           // Validate input
           $validator = Validator::make($request->all(), [
            'name' => 'required|unique:attribute_translations,name|min:3|max:100',
        ]);

        if ($validator->fails())
         {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create product attribute
      //  DB::beginTransaction();

        $attribute = ModelsAttribute::create($request->except([]));
        $attribute->name=$request->name;

        $attribute->save();
//        DB::commit();

        return redirect()->route('dashboard.attribute.index')->with(['success' => trans('msg.messageadd')]);
    } catch (\Exception $ex) {
    //    DB::rollBack(); // Corrected this line
        return redirect()->route('dashboard.attribute.index')->with(['error' => trans('msg.Somethingwrong')]);
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
        $attribute=ModelsAttribute::find($id);
      //  dd($attribute);

        return view('dashboard.attributes.edit' ,compact('attribute')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try{
            // Validate input
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:attribute_translations,name|min:3|max:100',
            ]);

         if ($validator->fails())
          {
             return redirect()->back()->withErrors($validator)->withInput();
         }


       //  DB::beginTransaction();


       $attribute= ModelsAttribute::orderBy('id','DESC')->find($id);
        if (!$attribute) {
            return redirect()->route('dashboard.barnd.index')->with(['error' => trans('msg.brandnotfound')]);

        }

        $attribute->update($request->except([]));
        $attribute->save();

 //        DB::commit();

         return redirect()->route('dashboard.attribute.index')->with(['success' => trans('msg.messageupdate')]);
     } catch (\Exception $ex) {
     //    DB::rollBack(); // Corrected this line
         return redirect()->route('dashboard.attribute.index')->with(['error' => trans('msg.Somethingwrong')]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $attribute=ModelsAttribute::find($id);
        $attribute->delete();
        return redirect()->route('dashboard.attribute.index')->with(['success' => trans('msg.messagedelete')]);


    }
}
