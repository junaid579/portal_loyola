<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class fineTypesModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'fine_types';
	public $timestamps  = false;

}