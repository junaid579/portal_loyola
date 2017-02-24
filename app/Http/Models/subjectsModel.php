<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class subjectsModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'class_subjects';
	public $timestamps  = false;

}