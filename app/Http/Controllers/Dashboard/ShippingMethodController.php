<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateShippingMethod;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
class ShippingMethodController extends Controller
{
    public function editShippingMethod($type)
    {
        // 3 type free local outer
        if($type==='free')
        {
            $shippingMethod= Setting::where('key','free_shipping_label')->first();
        }
        elseif($type==='local')
        {
            $shippingMethod= Setting::where('key','local_label')->first();
        }
        elseif($type==='outer')
        {
            $shippingMethod= Setting::where('key','outer_label')->first();
        }
        else
        {
            $shippingMethod= Setting::where('key','free_shipping_label')->first();

        }
        return view('dashboard.settings.shipping.editShippingMethod',compact('shippingMethod'));

    }



    public function updateShippingMethod(Request $request, $id)
    {
        $rules= [
            'id' => 'required|exists:settings,id',
            'value' => 'required|string', // Ensure 'value' is a string (if needed)
            'plain_value' => 'required|numeric', // Fixed required/nullable conflict
        ];

        try{
            $setting = Setting::find($id);
            $setting->toArray();
            DB::beginTransaction();


            if (!$setting) {
                return redirect()->back()->with(['error' => 'Setting not found']);
            }
    // Debug request data

         //   $setting->update(['plain_value'=>$validatedData->plain_value]);
            // save translation
          //  $setting->value=$validatedData->value;
          $setting->update(['plain_value' => $request['plain_value']]);
        $setting->value = $request['value'];
        $setting->save();
            //$setting->save();
            DB::commit();

            return redirect()->back()->with(['success' =>'Updated Successfully']);


        }catch(\Exception $e)
        {
            DB::rollback();

            return redirect()->back()->with(['error' =>'someThing wrong']);


        }


    }
          // Debug setting object







}
