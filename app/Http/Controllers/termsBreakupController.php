<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\termsBreakupModel;
use App\Http\Models\classesModel;
use App\Http\Models\feeTypesModel;

use Session;
use Config;
use DB;

class termsBreakupController extends Controller
{
    
    public function index(){
    	$allbreaks = termsBreakupModel::all()->where('status','!=',0);
    	$data = array('allbreaks'=>$allbreaks);
        $classes = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        $data_class = array('classes'=>$classes);
        $types = feeTypesModel::all()->where('status','=',1);
        $data_fee_types = array('types'=>$types);
        return view('termsBreakup')->with($data)->with($data_class)->with($data_fee_types);
    } 

    public function insert(Request $request){

     	$this->validate($request, [
       	 	'class_id' => 'required',
            'type' => 'required',
            'term' => 'required',
            'term_month' => 'required',
            'term_amount' => 'required'
    	]);

    	$tbu = new termsBreakupModel;
    	$tbu->fee_type_id = $request->type;
    	$tbu->term = $request->term;
    	$tbu->class_id = $request->class_id;
        $tbu->term_month = $request->term_month;
        $tbu->term_amount = $request->term_amount;
        $tbu->status = 1;
    	$tbu->c_on = DB::raw('NOW()');
    	$tbu->c_by = Session::get('userid');
    	$tbu->m_on = DB::raw('NOW()');
    	$tbu->m_by = Session::get('userid');
	
    	if($tbu->save()){
    		Session::flash('message', 'Terms Break up '. $tbu->term .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/termsBreakup');
    }

    public function update(Request $request){


       $this->validate($request, [
            'edit_id' => 'required',
            'edit_class_id' => 'required',
            'edit_type' => 'required',
            'edit_term_amount' => 'required',
            'edit_term_month' => 'required',
            'edit_term' => 'required'
            ]);
        $tbu = termsBreakupModel::find($request->edit_id);
        $tbu->class_id = $request->edit_class_id;
        $tbu->fee_type_id = $request->edit_type;
        $tbu->term = $request->edit_term;
        $tbu->term_amount = $request->edit_term_amount;
        $tbu->term_month = $request->edit_term_month;
        $tbu->m_on = DB::raw('NOW()');
        $tbu->m_by = Session::get('userid');

        if($tbu->save()){
            Session::flash('message', 'Terms Break up '. $tbu->term .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/termsBreakup');
    } 
    public function statusupdate($id,$status){
        $tbu = termsBreakupModel::find($id);
        $tbu->m_on = DB::raw('NOW()');
        $tbu->m_by = Session::get('userid');
        $tbu->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($tbu->save()){
            Session::flash('message', 'Terms Break up '. $tbu->term .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/termsBreakup');
    }
  
}

