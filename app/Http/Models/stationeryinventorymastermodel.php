<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class stationeryinventorymasterModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'stationery_inventory_master';
    public $timestamps  = false;

}