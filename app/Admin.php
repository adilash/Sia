<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    //
    protected $table='ADMINS';

    protected $fillable=['username','Name','password'];

    public $timestamps= false;
    

}
