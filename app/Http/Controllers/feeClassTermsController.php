<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\feeClassTermsModel;
use App\Http\Models\classesModel;
use App\Http\Models\feeTypesModel;

use Session;
use Config;
use DB;

class feeClassTermsController extends Controller
{
    
    public function index(){
    	$allterms = feeClassTermsModel::all()->where('status','!=',0);
    	$data = array('allterms'=>$allterms);
        $classes = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        $data_class = array('classes'=>$classes);
        $types = feeTypesModel::all()->where('status','=',1);
        $data_fee_types = array('types'=>$types);
        return view('feeClassTerms')->with($data)->with($data_class)->with($data_fee_types);
    } 

    public function insert(Request $request){

     	$this->validate($request, [
       	 	'class_id' => 'required',
            'type' => 'required',
            'terms' => 'required',
            'amount' => 'required'
    	]);

    	$fct = new feeClassTermsModel;
    	$fct->fee_type_id = $request->type;
    	$fct->terms = $request->terms;
    	$fct->class_id = $request->class_id;
        $fct->amount = $request->amount;
        $fct->status = 1;
    	$fct->c_on = DB::raw('NOW()');
    	$fct->c_by = Session::get('userid');
    	$fct->m_on = DB::raw('NOW()');
    	$fct->m_by = Session::get('userid');
	
    	if($fct->save()){
    		Session::flash('message', 'Term Amount '. $fct->amount .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/feeClassTerms');
    }

    public function update(Request $request){


       $this->validate($request, [
            'edit_id' => 'required',
            'edit_class_id' => 'required',
            'edit_type' => 'required',
            'edit_amount' => 'required',
            'edit_terms' => 'required'
            ]);
        $fct = feeClassTermsModel::find($request->edit_id);
        $fct->class_id = $request->edit_class_id;
        $fct->fee_type_id = $request->edit_type;
        $fct->terms = $request->edit_terms;
        $fct->amount = $request->edit_amount;
        $fct->m_on = DB::raw('NOW()');
        $fct->m_by = Session::get('userid');

        if($fct->save()){
            Session::flash('message', 'Amount '. $fct->amount .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/feeClassTerms');
    } 
    public function statusupdate($id,$status){
        $fct = feeClassTermsModel::find($id);
        $fct->m_on = DB::raw('NOW()');
        $fct->m_by = Session::get('userid');
        $fct->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($fct->save()){
            Session::flash('message', 'Amount '. $fct->amount .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/feeClassTerms');
    }
  
}

