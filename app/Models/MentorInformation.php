<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MentorInformation extends Model
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
    public function province()
    {
        return $this->hasOne(Province::class,'id');
    }

}
