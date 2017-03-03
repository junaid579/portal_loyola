<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class testmasterModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'test_master';
	public $timestamps  = false;

}