<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class mothertongueModel extends MyBaseModel {

    protected $connection = 'key';
    protected $table = 'mother_tongue';
    public $timestamps  = false;

}