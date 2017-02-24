<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class YearDbDetailsModel extends Model {

	protected $table = 'year_db_details';
	protected $fillable = ['id'];
	public $timestamps  = false;

	public static function findOne($id){
		return static::where('id',$id)->first();
	}
	public static function findIdYears(){
		return static::select('id','academic_year')
						->where('status',1)
						->orderBy('id', 'desc')
						->get();
	}
}