<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //to allow mass assignment
        public $fillable =['name','label'];




        public function roles(){
        	return $this->belongsToMany(Role::class);
        }

}
