<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Storage;

class StudentImage extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if (!empty($item->image) && Storage::disk('public')->exists(public_path('upload/images/' . $item->image)))
                Storage::disk('public')->delete(public_path('upload/images/' . $item->image));
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
