<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\staffModel;

use Session;
use Config;
use DB;

class staffController extends Controller
{
    
    public function index(){
    	$allstaff = staffModel::all()->where('status','!=',0);
    	//$data = array('allstaff'=>$allstaff);
        //return view('staff')->with($data);
        return view('staff') -> with(compact('allstaff'));

    } 

    public function insert(Request $request){

     	$this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'mail' => 'required',
        	]);

    	$stf = new staffModel;
    	$stf->f_name = $request->first_name;
    	$stf->l_name = $request->last_name;
        $stf->mobile = $request->mobile;
        $stf->email = $request->mail;
        $stf->status = 1;
    	$stf->c_on = DB::raw('NOW()');
    	$stf->c_by = Session::get('userid');
    	$stf->m_on = DB::raw('NOW()');
    	$stf->m_by = Session::get('userid');
	
    	if($stf->save()){
    		Session::flash('message', 'Staff member '. $stf->f_name ." ".$stf->l_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/staff');
    }
    public function update(Request $request){
       $this->validate($request, [
            'edit_id' => 'required',
            'edit_fname' => 'required',
            'edit_lname' => 'required',
            'edit_mobile' => 'required',
            'edit_mail' => 'required'
            ]);

        $stf = staffModel::find($request->edit_id);
        $stf->f_name = $request->edit_fname;
        $stf->l_name = $request->edit_lname;
        $stf->mobile = $request->edit_mobile;
        $stf->email = $request->edit_mail;
        $stf->m_on = DB::raw('NOW()');
        $stf->m_by = Session::get('userid');

        if($stf->save()){
            Session::flash('message', 'Staff member details '. $stf->f_name ." ".$stf->l_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/staff');
    } 
    public function statusupdate($id,$status){
        $stf = staffModel::find($id);
        $stf->m_on = DB::raw('NOW()');
        $stf->m_by = Session::get('userid');
        $stf->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($stf->save()){
            Session::flash('message', 'Staff member details  '. $stf->f_name ." ".$stf->l_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/staff');
    }
  
}

