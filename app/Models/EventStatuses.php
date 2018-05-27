<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStatuses extends Model
{
    protected $fillable = [
        'title'
    ];
    public $timestamps = false;
}
