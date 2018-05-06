<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'name',
        'type_id',
        'event_id'
    ];

    protected $table = 'elections';

    public $timestamps = false;

    public function GetTableName(){
        return $this->table;
    }

    public function levels()
    {
        return $this->hasMany(ElectionLevel::class);
    }
}
