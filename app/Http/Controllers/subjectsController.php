<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\subjectsModel;
use App\Http\Models\classesModel;

use Session;
use Config;
use DB;

class subjectsController extends Controller
{
    
    public function index(){
    	$allsubjects = subjectsModel::all()->where('status','!=',0)->sortByDesc("sequences");
    	$data = array('allsubjects'=>$allsubjects);
        $classes = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        $data_class = array('classes'=>$classes);
        return view('subjects')->with($data)->with($data_class);
    } 

    public function insert(Request $request){

     	$this->validate($request, [
       	 	'class_id' => 'required',
            'subject' => 'required'
        	]);

    	$sub = new subjectsModel;
    	$sub->subject_name = $request->subject;
    	$sub->class_id = $request->class_id;
        $sub->status = 1;
    	$sub->c_on = DB::raw('NOW()');
    	$sub->c_by = Session::get('userid');
    	$sub->m_on = DB::raw('NOW()');
    	$sub->m_by = Session::get('userid');
	
    	if($sub->save()){
    		Session::flash('message', 'Subject '. $sub->subject_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/subjects');
    }
    public function update(Request $request){
       $this->validate($request, [
            'edit_id' => 'required',
            'edit_subject' => 'required',
            ]);

        $sub = subjectsModel::find($request->edit_id);
        $sub->subject_name = $request->edit_subject;
        $sub->m_on = DB::raw('NOW()');
        $sub->m_by = Session::get('userid');

        if($sub->save()){
            Session::flash('message', 'Subject '. $sub->subject_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/subjects');
    } 
    public function statusupdate($id,$status){
        $sub = subjectsModel::find($id);
        $sub->m_on = DB::raw('NOW()');
        $sub->m_by = Session::get('userid');
        $sub->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($sub->save()){
            Session::flash('message', 'Subject '. $sub->class_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/subjects');
    }
  
}

