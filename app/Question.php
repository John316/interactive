<?php

namespace App;
use Composer\Script\Event;
use DB;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text',
        'rate',
        'client_event_id',
        'user_id',
        'status'
    ];

    protected $table = 'questions';

    public function scopeAll($query)
    {
        return $query->limit(30)->get();
    }

    public function scopeGetByEventId($query, $id)
    {
        return $query->where('client_event_id', '=', $id)->get();
    }

    public function events()
    {
        return $this->belongsTo(ClientEvent::class);
    }

}
