<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationModel extends Model
{
    protected $table = 'locations';

    protected function users(){
        return $this->hasMany('App\User');
    }
}
