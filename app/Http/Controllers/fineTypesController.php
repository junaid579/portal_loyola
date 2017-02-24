<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\fineTypesModel;

use Session;
use Config;
use DB;

class fineTypesController extends Controller
{
    
    public function index(){
    	$allfineTypes = fineTypesModel::all()->where('status','!=',0);
    	$data = array('allfineTypes'=>$allfineTypes);
        return view('fineTypes')->with($data);
    } 

    public function insert(Request $request){

     	$this->validate($request, [
            'fine_name' => 'required',
            'heading'  => 'required'
        	]);

    	$fnty = new fineTypesModel;
    	$fnty->fine_name = $request->fine_name;
    	$fnty->heading_on_bill = $request->heading;
        $fnty->status = 1;
    	$fnty->c_on = DB::raw('NOW()');
    	$fnty->c_by = Session::get('userid');
    	$fnty->m_on = DB::raw('NOW()');
    	$fnty->m_by = Session::get('userid');
	
    	if($fnty->save()){
    		Session::flash('message', 'Fine Type '. $fnty->fine_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/fineTypes');
    }
    public function update(Request $request){
       $this->validate($request, [
            'edit_id' => 'required',
            'edit_fine_type' => 'required',
            'edit_heading' => 'required'
            ]);

        $fnty = fineTypesModel::find($request->edit_id);
        $fnty->fine_name = $request->edit_fine_type;
        $fnty->heading_on_bill = $request->edit_heading;
        $fnty->m_on = DB::raw('NOW()');
        $fnty->m_by = Session::get('userid');

        if($fnty->save()){
            Session::flash('message', 'Fine Type '. $fnty->fine_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/fineTypes');
    } 
    public function statusupdate($id,$status){
        $fnty = fineTypesModel::find($id);
        $fnty->m_on = DB::raw('NOW()');
        $fnty->m_by = Session::get('userid');
        $fnty->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($fnty->save()){
            Session::flash('message', 'Fine Type  '. $fnty->fine_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/fineTypes');
    }
  
}

