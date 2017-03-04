<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class pickpointModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'transport_pickup';
	public $timestamps  = false;

}