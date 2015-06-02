<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(){
        return $this->hasMany('App\Task');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasRole($roles){
        if($this->getRole() == 'manage') return true;

        if(is_array($roles)) {
            foreach($roles as $role) {
                if($this->checkIfUserHasRole($role)){
                    return true;
                }
            }
        }else return $this->checkIfUserHasRole($roles);

        return false;
    }

    /**
     * @return mixed
     */
    public function getRole(){
        return \Auth::user()->role;
    }

    /**
     * @param $role
     * @return bool
     */
    public function checkIfUserHasRole($role){
        return $role == $this->getRole() ? true : false;
    }
}
