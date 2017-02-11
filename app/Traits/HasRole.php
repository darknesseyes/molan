<?php 
namespace App\Traits;

trait HasRole {


public function roles(){

	return $this->belongsToMany(Role::class);
}//end of Roles



public function assignRole($role){

	return $this->roles()->save(
		Role::whereName($role)->firstOrFail()
		);
}//end of assignRole


public function hasRole($role){

if (is_string($role)){
    return $this->roles->contains('name',$role);
}//end of if statement

return !! $role->intersect($this->roles)->count();
}//end of hasRole

	
}// end of HasRole Trait 