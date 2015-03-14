<?php namespace UnifySchool\Entities\School;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * UnifySchool\SchoolAdministrator
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * */
class SchoolAdministrator extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('password')) {
                $model->attributes['password'] = \Hash::make($model->attributes['password']);
            }
        });
    }


    public function school()
    {
        return $this->belongsTo('UnifySchool\School');
    }
}
