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

    public function scopeLastAdded($query)
    {
        $query->orderBy('created_at', 'desc')->first();
    }

    public function scopeCurrent($query)
    {
        $query->where('active_from', '=', Carbon::today());
    }

    public function scopeFuture($query)
    {
        $query->where('active_from', '>', Carbon::today());
    }

    public function scopeAll($query)
    {
        $query->limit(3);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function elections()
    {
        return $this->hasMany(Election::class, 'event_id');
    }

    public function scopeGetStatistic($query)
    {
        return $query->where('id', $this->id)->with('elections.levels')->get();
    }
}
