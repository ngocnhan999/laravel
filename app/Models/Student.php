<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Notifications\Student\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{

    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'email',
        'password',
        'avatar_id',
        'dob',
        'phone',
        'description',
        'gender',
        'facebook_id',
        'google_id',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'password',
        'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->display_name;
    }

    public function reference()
    {
        return $this->morphOne(StudentInformation::class, 'reference');
    }

    public function images()
    {
        return $this->morphMany(StudentImage::class, 'imageable');
    }

    /**
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(StudentImage::class, 'imageable')
            ->where('type', '=', 'house');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image_people()
    {
        return $this->morphOne(StudentImage::class, 'imageable')
            ->where('type', '=', 'people');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image_family()
    {
        return $this->morphOne(StudentImage::class, 'imageable')
            ->where('type', '=', 'family');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file_letter()
    {
        return $this->morphOne(StudentImage::class, 'imageable')
            ->where('type', '=', 'letter');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image_multiple()
    {
        return $this->morphMany(StudentImage::class, 'imageable')->where('type', '=', 'multiple');
    }
}
