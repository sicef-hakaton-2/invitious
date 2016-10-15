<?php

namespace App;
use App\OrganizationModel;
use App\User;
use Illuminate\Database\Eloquent\Model;

class HostedModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hosted';


    protected function users(){
        return $this->hasMany('App\User');
    }
    protected function organizations(){
        return $this->hasMany('App\OrganizationModel');
    }
}
