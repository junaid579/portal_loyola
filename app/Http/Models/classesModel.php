<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class classesModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'classes';
	public $timestamps  = false;

	public static function findUser($id){
		return static::where('id',$id)->first();
	}

	


}