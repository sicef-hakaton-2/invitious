<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrganizationModel extends Model
{
    protected $table = 'organizations';

    public static function queryDB($query)
    {
        return(DB::select( DB::raw($query)));
    }
}

