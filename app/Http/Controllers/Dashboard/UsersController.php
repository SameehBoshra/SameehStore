<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Hash;
use Auth;
use App\Image;

class UsersController extends Controller {

    /**
    * render and paginate the users page.
    *
    * @return string
    */
    public function index() {
         $users = Admin::latest()->where('id', '<>', auth()->id())->get(); //use pagination here
        return view('dashboard.users.index', compact('users'));
    }

    public function create(){
        $roles = Role::get();
        return view('dashboard.users.create',compact('roles'));
    }


    public function store(AdminRequest $request) {
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);   // the best place on model
        $user->role_id = $request->role_id;

        // save the new user data
        if($user->save())
             return redirect()->route('dashboard.users.index')->with(['success' =>trans('msg.messageadd')]);
        else
            return redirect()->route('dashboard.users.index')->with(['success' => trans('msg.Somethisomethingwrongngwrong')]);

    }


    public function edit(string $id)
    {
        $user=Admin::orderBy('id','DESC')->find($id);
        $roles = Role::get();

        return view('dashboard.users.edit' , compact('user','roles'));
    }


    public function update(AdminRequest $request,  $id)
    {

      try{

        // Find the admin
        $user= Admin::orderBy('id','DESC')->find($id);
        if (!$user) {
            return redirect()->route('dashboard.users.index')->with(['error' => trans('msg.Somethingwrong')]);
        }
        // Update admin details


      $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id,
    ]);


      $user->save();

        return redirect()->route('dashboard.users.index')->with(['success' => trans('msg.messageupdate')]);
     }catch(\Exception $ex)
    {
        return redirect()->route('dashboard.users.index')->with(['error' => trans('msg.Somethingwrong')]);

    }




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $user =Admin::orderBy('id','DESC')->find($id);
            $user->delete();

            return redirect()->route('dashboard.users.index')->with(['success'=>trans('msg.messagedelete')]);
        }catch(\Exception $e)
        {
            return redirect()->route('dashboard.users.index')->with(['error'=>trans('msg.Somethingwrong')]);

        }



    }
}
