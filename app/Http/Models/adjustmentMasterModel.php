<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class adjustmentMasterModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'fee_adjustments_master';
    public $timestamps  = false;

}