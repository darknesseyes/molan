<?php

namespace App;
use App\Traits\HasRole;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    // roles

    public function roles(){
        return $this->belongsToMany(Role::class);
    }// end of roles

    public function activate(User $user){

    $user->active = 1;
    $user->update();
    }

public function deactivate(User $user){
    $user->active = 0;
    $user->update();
}

}
