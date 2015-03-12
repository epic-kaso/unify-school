<?php namespace SupergeeksGadgetSwap;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

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
    protected $fillable = ['last_name', 'first_name', 'phone_number', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        $roles = explode(',', $this->role);
        return in_array('admin', $roles);
    }

    public function isAdviser()
    {
        $roles = explode(',', $this->role);
        return in_array('adviser', $roles);
    }

    public function setAsAdviser()
    {
        $this->role = 'adviser';
    }

}
