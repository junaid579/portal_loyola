<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\occupationModel;




use Session;
use Config;
use DB;

class occupationController extends Controller
{
    
    public function index(){
    	$alloccupations = occupationModel::all()->where('status','!=',0);
    	$data = array('alloccupations'=>$alloccupations);
        return view('occupation')->with($data);
                               
    	
    } 

    public function insert(Request $request){

     	$this->validate($request, [
       	 	'occupation' => 'required',
    	]);

    	$occ = new occupationModel;
    	$occ->occupation_details = $request->occupation;
        $occ->status = 1;
    	$occ->c_on = DB::raw('NOW()');
    	$occ->c_by = Session::get('userid');
    	$occ->m_on = DB::raw('NOW()');
    	$occ->m_by = Session::get('userid');
	
    	if($occ->save()){
    		Session::flash('message', 'Occupation '. $occ->occupation_details .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/occupation');
    }

    public function update(Request $request){
       $this->validate($request, [
            'edit_id' => 'required',
            'edit_occupation' => 'required',
            ]);

        $occ = occupationModel::find($request->edit_id);
        $occ->occupation_details = $request->edit_occupation;
        $occ->m_on = DB::raw('NOW()');
        $occ->m_by = Session::get('userid');

        if($occ->save()){
            Session::flash('message', 'Occupation '. $occ->occupation_details .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/occupation');
    } 
    public function statusupdate($id,$status){
        $occ = occupationModel::find($id);
        $occ->m_on = DB::raw('NOW()');
        $occ->m_by = Session::get('userid');
        $occ->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($occ->save()){
            Session::flash('message', 'Occupation '. $occ->occupation_details .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/occupation');
    }
  
}

