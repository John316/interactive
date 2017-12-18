<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlidesOnline extends Model
{
    protected $fillable = [
        'event_id',
        'active_slide',
        'rating'
    ];
}