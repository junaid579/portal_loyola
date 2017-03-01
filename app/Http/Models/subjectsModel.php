<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class subjectsModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'subjects';
	public $timestamps  = false;

}