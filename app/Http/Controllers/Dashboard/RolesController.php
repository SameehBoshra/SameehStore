<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get(); // use pagination and  add custom pagination on index.blade
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.roles.create');
    }

    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }

    public function saveRole(RolesRequest $request)
    {

        try {

            $role = $this->process(new Role, $request);
            if ($role)
                return redirect()->route('dashboard.roles.index')->with(['success' => trans('msg.messageadd')]);
            else
                return redirect()->route('dashboard.roles.index')->with(['error' =>  trans('msg.Somethingwrong')]);
        } catch (\Exception $ex) {
            return $ex;
            // return message for unhandled exception
            return redirect()->route('admin.roles.index')->with(['error' => trans('msg.Somethingwrong')]);
        }
    }

    public function edit($id)
    {
          $role = Role::findOrFail($id);
        return view('dashboard.roles.edit',compact('role'));
    }

    public function update($id,RolesRequest $request)
    {
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role)
                return redirect()->route('dashboard.roles.index')->with(['success' =>  trans('msg.messageupdate')]);
            else
                return redirect()->route('dashboard.roles.index')->with(['error' =>  trans('msg.Somethingwrong')]);
        } catch (\Exception $ex) {
            // return message for unhandled exception
            return redirect()->route('dasadminhboard.roles.index')->with(['error' =>  trans('msg.Somethingwrong')]);
        }
    }

    public function destroy( $id)
    {
        try{
            $role =Role::orderBy('id','DESC')->find($id);
            $role->delete();

            return redirect()->route('dashboard.roles.index')->with(['success'=>trans('msg.messagedelete')]);
        }catch(\Exception $e)
        {
            return redirect()->route('dashboard.roles.index')->with(['error'=>trans('msg.Somethingwrong')]);

        }



    }


}
