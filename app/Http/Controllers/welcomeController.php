<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\yearDbDetailsModel;

use Session;
use Config;
use DB;

//for curd https://www.sitepoint.com/crud-create-read-update-delete-laravel-app/
//for sessions https://laravel.com/docs/5.2/session
//auth check https://laravel.io/forum/01-06-2015-authcheck-is-not-working
//webapi https://laracasts.com/discuss/channels/general-discussion/laravel-5-api-auth-for-a-mobile-app-or-another-web-application

class welcomeController extends Controller
{
    
    public function index(){
    	$idyears = yearDbDetailsModel::findIdYears();
    	$data = array('idyears'=>$idyears);
    	return view('login')->with($data);
    }
    
    public function logout(){
        Session::flush();
        return redirect('/');
    }
  
}
