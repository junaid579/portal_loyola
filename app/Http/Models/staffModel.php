<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class staffModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'staff';
	public $timestamps  = false;

}