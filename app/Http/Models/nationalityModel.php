<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class nationalityModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'nationality';
    public $timestamps  = false;

}