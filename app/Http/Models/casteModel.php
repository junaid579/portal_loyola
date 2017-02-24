<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class casteModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'caste';
	public $timestamps  = false;

}