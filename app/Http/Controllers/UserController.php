<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\CreateNewUserRequest;

use App\User;
use App\Role;
use Alert;
use DB;

class UserController extends Controller
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
        $users = User::with('roles')->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewUserRequest $request)
    {
        //
        DB::transaction(function() use ($request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        
         $user->save();
         $newlyCreatedUser = User::where('email',$request->email)->get();
         $user->roles()->attach($request->role);
         Alert::success('New user has been added','success');
        });
         return redirect('/users/index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $roles = Role::all();
        return view('admin.users.edit',compact('user','roles'));
    }



public function toggle_active(User $user){
if($user->active == 0){
$user->activate($user);
        Alert::success('The user has been activated Successfully');
return back();
}
$user->deactivate($user);
        Alert::success('The user has been deactivated Successfully');
return back();

}// end of toggle_active method
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        
        //validte the request 
        if($request->password == null && $request->password_confirmation ==null)
        {
        $this->validate(request(),['name'=>'required','email'=>'required|email|max:255']);

        }
     // if password is not null then validate passwword
        if($request->password !== null || $request->password_confirmation !==null)
        {
        $this->validate(request(),[
        'name'=>'required',
        'email'=>'required|email|max:255',
        'password'=>'required|min:6|confirmed'
        ]);

                //to check if there is actually a change in the fields 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->roles()->detach();
        $user->roles()->attach($request->role);
        $user->update();
        Alert::success('User has been updated successfully');
        return redirect('/users');
         // use DB transaction to update the user and assign a role 
        
        }
        $user->roles()->detach();
        $user->roles()->attach($request->role);
        //$user->update($request->all());
        $user->update(request(['name','email']));
        return redirect('/users');
        
    }


// login from admin to any user account

    public function login(User $user){
      auth()->login($user);
      Alert::warning('You are logged in as '.$user->name);
      return redirect('/home');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

           DB::transaction(function() use ($user){
           $user->roles()->detach();
           $user->delete();
           Alert::success('User has been deleted successfully');
           
           });
       return back(); 

    }
}
