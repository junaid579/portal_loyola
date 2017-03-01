<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class consessionTypeMasterModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'consession_master';
    public $timestamps  = false;

}