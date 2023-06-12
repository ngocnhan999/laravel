<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Notifications\Mentor\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mentor extends Authenticatable
{

    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'mentors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'region',
        'email',
        'password',
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

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPasswordNotification($token));
    // }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->display_name;
    }

    public function reference()
    {
        return $this->morphOne(MentorInformation::class, 'reference');
    }

}
