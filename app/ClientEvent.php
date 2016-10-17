<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientEvent extends Model
{
    protected $fillable = [
        'name',
        'description',
        'published_from',
        'status'
    ];
}
