<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class occupationModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'occupation';
	public $timestamps  = false;

}