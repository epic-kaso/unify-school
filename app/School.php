<?php namespace SupergeeksGadgetSwap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * SupergeeksGadgetSwap\School
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $hashcode
 * @property string $school_object
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereHashcode($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereSchoolObject($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\SupergeeksGadgetSwap\School whereUpdatedAt($value)
 */
class School extends Model
{

    protected $guarded = ['id', 'slug', 'hashcode'];

    protected $casts = [
        'school_object' => 'object'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function (School $model) {
            if ($model->isDirty('name')) {
                $model->generateSlug();
            }
        });
    }

    private function generateSlug($count = null)
    {
        $this->attributes['slug'] = Str::slug($this->name . ' ' . $this->city . ' ' . $this->state . ' ' . $this->country . ' ' . $count);

        if (!is_null(static::bySlug($this->attributes['slug']))) {
            $count = is_null($count) ? $count = 0 : ++$count;
            return $this->generateSlug($count);
        }

        return true;
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }
}
