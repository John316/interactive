<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectionLevel extends Model
{
    protected $fillable = [
        'level',
        'user_id',
        'election_id'
    ];

    protected $table = 'election_levels';
}
