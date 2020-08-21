<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    public $timestamps = true; //this set the created and updated at everytime i enter data in db
    protected $guarded = [];
}
