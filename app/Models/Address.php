<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['id', 'city', 'street', 'country', 'post_code', 'country_iso', 'flat_number', 'house_number'];

    /**
     * @param \Spatie\Activitylog\Models\Activity $activity
     * @param string                              $eventName
     */
    public function tapActivity(Activity $activity, string $eventName)
    {
        if(request()->post('auth_user_id'))
        {
            $activity->causer_id = request()->post('auth_user_id');
            $activity->causer_type = 'App\Models\User';
        }
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'city',
        'street',
        'house_number',
        'flat_number',
        'post_code',
        'country',
        'country_iso',
    ];

}
