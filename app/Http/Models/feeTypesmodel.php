<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class feeTypesModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'fee_types';
	public $timestamps  = false;

}