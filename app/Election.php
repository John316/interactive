<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
  public function GetTableName(){
    return $this->table;
  }

    protected $fillable = [
        'name',
        'type_id',
        'event_id'
    ];

    protected $table = 'elections';
}
