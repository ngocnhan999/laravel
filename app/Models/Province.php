<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * @var string
     */
    protected $table = 'provinces';
    /**
     * @var bool
     */

    public $timestamps = false;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'name_en'
    ];
}
