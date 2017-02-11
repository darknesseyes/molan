<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Alert;
use DB;
use Illuminate\Http\Request;
use \App\Http\Requests\RoleFormRequest;

class RoleController extends Controller
{
  /**
   * protect it by auth middleware.
   *
   * @return \Illuminate\Http\Response
   */

public function __construct(){
  return $this->middleware('auth');
}
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',compact('roles'));
    }



public function removePermission(Role $role,$permission_id)
{
   $role->permissions()->detach($permission_id);
   Alert::success('Removed Successfully');
   return back();
}

public function assignPermission(Role $role,$permission_id)
{
   if($role->permissions()->where('permission_id',$permission_id)->count() == 0){
   $role->permissions()->attach($permission_id);
   Alert::success('Assigned Successfully');
   return back();
}
 Alert::warning('The user has already this permission');
return back();
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        //validate the request // the form request did the job
        Role::create(request(['name','label']));
        //return redirect
        Alert::success('The Role has been Added Successfully', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($role)
    {
        //
        $permissions = Permission::all();
       $role = Role::with('permissions')->find($role);
        return view('admin.roles.show',compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('admin.roles.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //validate request
       $this->validate(request(),['name'=>'required','label'=>'required']);

       // check if really there are changes
       if($role->name == $request->name && $role->label == $request->label)
       {
        return back()->withErrors(['message'=>'There are no changes to update the record']);
       }
       //if the data updated successfully return success message
       if($role->update($request->all()))
       {
        Alert::success('The role has been updated','success');
        return redirect('/roles');
       }
       return back()->withErrors(['message'=>'Can not update the record']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        //return $role->users()->count();
        DB::transaction(function() use ($role){
        if($role->users()->count() > 0){
        $user = $role->users;
        foreach($user as $user){
         $user->active = 0;
         $user->update();
        }
        $role->users()->detach();
        $role->delete();
    }
        $role->delete();
        Alert::success('Has been deleted Successfully', 'Success');   
        });

        return back();
   
    }
}
