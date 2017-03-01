<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class testtypeModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'test_type';
	public $timestamps  = false;

}