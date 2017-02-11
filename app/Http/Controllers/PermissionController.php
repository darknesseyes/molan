<?php

namespace App\Http\Controllers;

use App\Permission;
use Alert;
use DB;

use Illuminate\Http\Request;
use \App\Http\Requests\PermissionFormRequest as CreateRequest ;


class PermissionController extends Controller
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
        //
         $permissions = Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //

         Permission::create(request(['name','label']));
        Alert::success('The Permission has been Added Successfully', 'Success');
       return back();
   }
    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //

       return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Permission $permission)
    {
        //validate request
        $this->validate(request(),['name'=>'required','label'=>'required']);
        // check if the is really a change 
        // if there are no changes return with error message
        if ($permission->name == $request->name && $permission->label == $request->label)
            {
            return back()->withErrors(["message"=>"there is nothing to change"]);
            }
        // trying to update records
        if($permission->update($request->all())){
          Alert::success('updated successfully','success');
          return redirect('/permissions');
      }
      // if can't update return redirect with error message
       return redirect()->back()->withErrors(["message"=>"cant update there was a problem"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
      DB::transaction(function() use ($permission)
       {
        $permission->roles()->detach();
        $permission->delete();
        Alert::success('Has been deleted Successfully', 'Success');
        return back();
       });
       Alert::warning('Has been deleted Successfully');
       return back();
        // $p = Permission::findOrFail($permission);
        // if($p->delete($permission))
        // {
        // Alert::success('Has been deleted Successfully', 'Success');
        // return back();
        // }// end of if statement
        // return back();
    }// end of destroy method
}//end of PermissionController Class
