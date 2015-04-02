<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolProfile
 *
 * @property integer $id 
 * @property integer $school_id 
 * @property string $motto 
 * @property string $mission 
 * @property string $vision 
 * @property string $about 
 * @property string $contact_email 
 * @property string $contact_phone_number 
 * @property string $logo 
 * @property string $wallpaper 
 * @property string $established_date 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read School $school 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereMotto($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereMission($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereVision($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereContactEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereContactPhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereWallpaper($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereEstablishedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolProfile whereUpdatedAt($value)
 */
class SchoolProfile extends BaseModel {

    protected $guarded = ['id'];
    protected $hidden = ['id'];
    protected $casts = ['logo' => 'array'];

    public function school(){
        return $this->belongsTo(School::class);
	}
}
