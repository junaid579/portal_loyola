<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class stationeryGroupsModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'stationery_groups';
    public $timestamps  = false;

}