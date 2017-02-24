<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use Config;
use DB;

class MyBaseModel extends Model {
  public function __construct(){
  		Config::set('database.connections.key', array(
    		'driver'    => 'mysql',
            'host'      => Session::get('session_host'),
            'port' => Session::get('session_port'),
            'database'  => Session::get('session_db'),
            'username'  => Session::get('session_username'),
            'password'  => Session::get('session_password'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
		));
		DB::connection('key');
  }
}
