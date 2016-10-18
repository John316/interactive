<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ClientEvent extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'active_from',
        'active_to',
        'status'
    ];

    protected $dates = ['active_from'];

    protected $table = 'client_events';

    public function setActiveFromAttribute($date)
    {
        $this->attributes['active_from'] = Carbon::parse($date);
    }

    public function scopeCurrent($query)
    {
        $query->where('active_from', '=', Carbon::today());
    }

    public function scopeFuture($query)
    {
        $query->where('active_from', '>', Carbon::today());
    }

    public function user(){
        return $this->belongsToMany('users');
    }

    public function getMainStatistic()
    {
        return "";
    }
}
