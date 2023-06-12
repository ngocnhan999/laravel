<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StudentInformation extends Model
{

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    protected $dates = [
        'created_at',
        'updated_at'
    ];


    /**
     * @return MorphTo
     */
    public function author() : MorphTo
    {
        return $this->morphTo();
    }


    /**
     * Article::getParamsAttribute()
     *
     * @param mixed $value
     * @return object
     */
    public function getParamsAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * Article::setParamsAttribute()
     *
     * @param mixed $value
     * @return void
     */
    public function setPersonalInfoAttribute($value)
    {
        $this->attributes['personal_info'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPersonalInfoAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * @param $value
     */
    public function setAcademicInfoAttribute($value)
    {
        $this->attributes['academic_info'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getAcademicInfoAttribute($value)
    {
        return json_decode($value, false);
    }

    public function getHighSchool()
    {
        return $this->academic_info->high_school;
    }

    /**
     * @param $value
     */
    public function setExperienceInfoAttribute($value)
    {
        $this->attributes['experience_info'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getExperienceInfoAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * @param $value
     */
    public function setFinanceInfoAttribute($value)
    {
        $this->attributes['finance_info'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getFinanceInfoAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * @param $value
     */
    public function setFamilyMembersAttribute($value)
    {
        $this->attributes['family_members'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::parse(str_replace('/','-',$value))->format('Y-m-d');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getFamilyMembersAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * @param $value
     */
    public function setPersonalSharingAttribute($value)
    {
        $this->attributes['personalSharing'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPersonalSharingAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * @param $value
     */
    public function setEssaysAttribute($value)
    {
        $this->attributes['essays'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getEssaysAttribute($value)
    {
        return json_decode($value, false);
    }

    public function setVietseedsQuizAttribute($value)
    {
        $this->attributes['vietseeds_quiz'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getVietseedsQuizAttribute($value)
    {
        return json_decode($value, false);
    }

    /**
     * @param $value
     */
    public function setPhotosAttribute($value)
    {
        $this->attributes['photos'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
