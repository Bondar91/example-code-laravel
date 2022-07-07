<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Billing extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'city',
        'street',
        'house_number',
        'flat_number',
        'post_code',
        'nip',
        'is_company',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_company' => 'boolean',
    ];

}
