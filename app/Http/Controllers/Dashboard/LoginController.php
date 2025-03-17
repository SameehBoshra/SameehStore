<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }


    public function postlogin(AdminLoginRequest $request)
    {
       // validate request
       // check it in database
    $remember_me=$request->has('remember_me')?true:false;
    if(Auth()->guard('admin')->attempt(
        [
            'email'=>$request->input('email') ,
             'password'=>$request->input('password')
        ]
            ))
    {
        return redirect()->route('dashboard.index');

    }
    else
    {
        return redirect()->back()->with(['error'=>'بينانات الدخول غير صحيحه ']);

    }


    }


    public function logout()
    {

       // Log out the admin user
    Auth::guard('admin')->logout();

    // Invalidate the session to prevent reuse
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('admin.login');

    }

    public function editProfile(Request $request)
    {
       $dataOfAdmin= Admin::find($request->id);
        return view('dashboard/auth.editProfile',compact('dataOfAdmin'));
    }


    public function updateProfile(Request $request,$id)
    {
       /* $valid = [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:admins,email' ,
            'password' => 'required|min:6|max:100', // Only required when provided
        ];

        $errormsg = [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.min' => 'The password must be at least 6 characters.',
        ];

        // Validate input
        $validator = Validator::make($request->all(), $valid, $errormsg);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        */
        // Find the admin
        $dataOfAdmin= Admin::where('id', $id)->first();

        if (!$dataOfAdmin) {
            return redirect()->back()->withErrors(['error' => 'Admin not found.']);
        }

        // Update admin details
       $name= $dataOfAdmin->name = $request->name;
        $dataOfAdmin->email = $request->email;



        // Update password only if provided
        if ($request->filled('password')) {
            $dataOfAdmin->password = bcrypt($request->password);
        }

        $dataOfAdmin->save();

        return redirect()->back()->with(['success' => 'Admin updated successfully!']);
  /*   $find = Admin::where('id', $id)->first();
    if(!$find)
    {
        return 'no';
    }
    return $find;
 */
    }
}
