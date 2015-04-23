<?php namespace UnifySchool;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * UnifySchool\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\User whereUpdatedAt($value)
 */
class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
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
