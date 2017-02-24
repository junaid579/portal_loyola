<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\casteModel;




use Session;
use Config;
use DB;

class casteController extends Controller
{
    
    public function index(){
    	$allcastes = casteModel::all()->where('status','!=',0);
    	$data = array('allcastes'=>$allcastes);
        return view('caste')->with($data);
                               
    	
    } 

    public function insert(Request $request){

     	$this->validate($request, [
       	 	'caste_name' => 'required',
            'caste_code' => 'required'
    	]);

    	$cas = new casteModel;
    	$cas->caste_name = $request->caste_name;
    	$cas->caste_code = $request->caste_code;
        $cas->status = 1;
    	$cas->c_on = DB::raw('NOW()');
    	$cas->c_by = Session::get('userid');
    	$cas->m_on = DB::raw('NOW()');
    	$cas->m_by = Session::get('userid');
	
    	if($cas->save()){
    		Session::flash('message', 'Caste '. $cas->caste_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/caste');
    }

    public function update(Request $request){
       $this->validate($request, [
            'edit_id' => 'required',
            'edit_caste' => 'required',
            'edit_code' => 'required'
            ]);

        $cas = casteModel::find($request->edit_id);
        $cas->caste_name = $request->edit_caste;
        $cas->caste_code = $request->edit_code;
        $cas->m_on = DB::raw('NOW()');
        $cas->m_by = Session::get('userid');

        if($cas->save()){
            Session::flash('message', 'Caste '. $cas->caste_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/caste');
    } 
    public function statusupdate($id,$status){
        $cas = casteModel::find($id);
        $cas->m_on = DB::raw('NOW()');
        $cas->m_by = Session::get('userid');
        $cas->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($cas->save()){
            Session::flash('message', 'Caste '. $cas->caste_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/caste');
    }
  
}

