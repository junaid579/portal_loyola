<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class feeClassTermsModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'fee_class_terms';
	public $timestamps  = false;

}