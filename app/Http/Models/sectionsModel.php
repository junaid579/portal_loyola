<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class sectionsModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'sections';
	public $timestamps  = false;

}