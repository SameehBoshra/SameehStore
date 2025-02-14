<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateProfileAdmin;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function editProfile()
    {
       $admin=Admin::find(auth('admin')->user()->id);
        return view('dashboard/Profile.editProfile' , compact('admin'));
    }


    public function updateProfile(Request $request)
    {
        $valid = [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:admins,email,' . $request->id,
            'password' => 'required|confirmed|min:6|max:100',
        ];

        $errormsg = [

        ];

        // Validate input
        $validator = Validator::make($request->all(), $valid, $errormsg);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Find the admin
        $dataOfAdmin= Admin::find(auth('admin')->user()->id);

        if (!$dataOfAdmin) {
            return redirect()->back()->withErrors(['error' => 'Admin not found.']);
        }
        if ($request->filled('password')) {
            // Hash the password
            $request->merge(['password' => bcrypt($request->password)]);
        }
        unset($request['password_confirmation']); // if need update in data base

        // Update admin details
      $dataOfAdmin->update($request->only(['name','email','password']));
        $dataOfAdmin->save();

        return redirect()->back()->with(['success' => trans('msg.adminsucess')]);

    }

}
