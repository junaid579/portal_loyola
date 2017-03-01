<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class stationeryGroupMasterModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'stationery_group_master';
    public $timestamps  = false;

}