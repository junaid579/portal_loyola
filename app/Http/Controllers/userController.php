<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\userModel;
use App\Http\Models\yearDbDetailsModel;
use App\Http\Models\classesModel;

use Session;
use Config;
use DB;

//for curd https://www.sitepoint.com/crud-create-read-update-delete-laravel-app/
//for sessions https://laravel.com/docs/5.2/session
//auth check https://laravel.io/forum/01-06-2015-authcheck-is-not-working
//webapi https://laracasts.com/discuss/channels/general-discussion/laravel-5-api-auth-for-a-mobile-app-or-another-web-application

class userController extends Controller
{
    
    public function login(Request $request){
    	$result = userModel::findUser($request->username,$request->password);
        if(count($result) == 1){
            Session::put('userid', $result['id']); 
            Session::put('username', $result['f_name']." ".$result['l_name']); 
            $db_con = yearDbDetailsModel::findOne($request->year);
            Session::put('session_host', $db_con['db_host']); 
            Session::put('session_port', $db_con['db_port']); 
            Session::put('session_db', $db_con['db_dbname']); 
            Session::put('session_username', $db_con['db_user']); 
            Session::put('session_password', $db_con['db_pwd']); 
            return redirect('dashboard');
        }else{
            Session::flash('error_message', 'Invalid Username or Password');
            return redirect('/');
        }
    }
    
    public function dashboard(){
        if(Session::exists('userid')){
            //$result = classesModel::findUser(1);
            return view('dashboard');    
        }else{
            Session::flash('error_message', 'Signin to access the page');
            return redirect('/');
        }
    }
    
}
