<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class termsBreakupModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'fee_terms_breakup';
	public $timestamps  = false;

}