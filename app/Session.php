<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';
    protected $guarded = [];

    public function getStartAtAttribute ($data)
    {
        return Carbon::parse($data)->toDayDateTimeString();


    } //end of getStartAtAttribute function

}
