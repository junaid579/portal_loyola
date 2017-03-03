<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class stationeryinventorymodel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'stationery_inventory';
    public $timestamps  = false;

}