<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientEvent extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'activeFrom',
        'activeTo',
        'status'
    ];

    public function user(){
        return $this->belongsToMany('users');
    }

    public function getMainStatistic()
    {
        return "";
    }
}
