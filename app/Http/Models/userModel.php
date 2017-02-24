<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class UserModel extends Model {

	protected $table = 'users';
	protected $fillable = ['username','password'];
	public $timestamps  = false;

	public static function findUser($username,$password){
		return static::where([
							['user_name','=',$username],
							['password','=',md5($password)],
							['status','=',1]
						])->first();
	}
}