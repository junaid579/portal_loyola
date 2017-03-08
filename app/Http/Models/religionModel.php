<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class religionModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'religion';
    public $timestamps  = false;

}