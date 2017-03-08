<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class countriesModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'countries';
	public $timestamps  = false;

}