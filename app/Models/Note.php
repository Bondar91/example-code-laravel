<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'noteable_type',
        'noteable_id',
        'note',
    ];

    public function noteable()
    {
        return $this->morphTo();
    }
}
