<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class paymentTypesMasterModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'payment_type_master';
    public $timestamps  = false;

}