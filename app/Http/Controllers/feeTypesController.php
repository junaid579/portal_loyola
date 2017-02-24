<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\feeTypesModel;

use Session;
use Config;
use DB;

class feeTypesController extends Controller
{
    
    public function index(){
    	$allfeeTypes = feeTypesModel::all()->where('status','!=',0);
    	$data = array('allfeeTypes'=>$allfeeTypes);
        return view('feeTypes')->with($data);
    } 

    public function insert(Request $request){

     	$this->validate($request, [
            'fee_name' => 'required',
            'heading'  => 'required'
        	]);

    	$fty = new feeTypesModel;
    	$fty->fee_name = $request->fee_name;
    	$fty->heading_on_bill = $request->heading;
        $fty->status = 1;
    	$fty->c_on = DB::raw('NOW()');
    	$fty->c_by = Session::get('userid');
    	$fty->m_on = DB::raw('NOW()');
    	$fty->m_by = Session::get('userid');
	
    	if($fty->save()){
    		Session::flash('message', 'Fee Type '. $fty->fee_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/feeTypes');
    }
    public function update(Request $request){
       $this->validate($request, [
            'edit_id' => 'required',
            'edit_fee_type' => 'required',
            'edit_heading' => 'required'
            ]);

        $fty = feeTypesModel::find($request->edit_id);
        $fty->fee_name = $request->edit_fee_type;
        $fty->heading_on_bill = $request->edit_heading;
        $fty->m_on = DB::raw('NOW()');
        $fty->m_by = Session::get('userid');

        if($fty->save()){
            Session::flash('message', 'Fee Type '. $fty->fee_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/feeTypes');
    } 
    public function statusupdate($id,$status){
        $fty = feeTypesModel::find($id);
        $fty->m_on = DB::raw('NOW()');
        $fty->m_by = Session::get('userid');
        $fty->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($fty->save()){
            Session::flash('message', 'Fee Type  '. $fty->fee_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/feeTypes');
    }
  
}

