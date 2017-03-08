<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class admissionModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'student_admission';
	public $timestamps  = false;

}