<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\sectionsModel;
use App\Http\Models\classesModel;

use Session;
use Config;
use DB;

class sectionsController extends Controller
{
    
    public function index(){
    	$allsections = sectionsModel::all()->where('status','!=',0)->sortByDesc("sequences");
    	
        $classes = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        
        //Data arrays
        //$data_class = array('classes'=>$classes);
        //$data = array('allsections'=>$allsections);
        //return view('sections')->with($data)->with($data_class);
        return view('sections') -> with(compact('classes', 'allsections'));
    } 

    public function insert(Request $request){

     	$this->validate($request, [
       	 	'class_id' => 'required',
            'section' => 'required',
        	'sequences' => 'required'
    	]);

    	$sec = new sectionsModel;
    	$sec->section_name = $request->section;
    	$sec->sequence = $request->sequences;
    	$sec->class_id = $request->class_id;
        $sec->status = 1;
    	$sec->c_on = DB::raw('NOW()');
    	$sec->c_by = Session::get('userid');
    	$sec->m_on = DB::raw('NOW()');
    	$sec->m_by = Session::get('userid');
	
    	if($sec->save()){
    		Session::flash('message', 'Section '. $sec->section_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/sections');
    }

    public function update(Request $request){


       $this->validate($request, [
            'edit_id' => 'required',
            'edit_classes' => 'required',
            'edit_sequences' => 'required',
            'edit_section' => 'required'
            ]);
        $sec = sectionsModel::find($request->edit_id);
        $sec->section_name = $request->edit_section;
        $sec->class_id = $request->edit_classes;
        $sec->sequence = $request->edit_sequences;
        $sec->m_on = DB::raw('NOW()');
        $sec->m_by = Session::get('userid');

        if($sec->save()){
            Session::flash('message', 'Section '. $sec->section_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/sections');
    } 
    public function statusupdate($id,$status){
        $sec = sectionsModel::find($id);
        $sec->m_on = DB::raw('NOW()');
        $sec->m_by = Session::get('userid');
        $sec->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($sec->save()){
            Session::flash('message', 'Section '. $sec->class_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/sections');
    }
    public function dashboard(){
        $allsections = sectionsModel::all()->where('status','=',1);
        $data = array('allsections'=>$allsections);
        $allclasses = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        $data_class = array('allclasses'=>$allclasses);
        return view('/dashboard')->with($data)->with($data_class);
    } 
  
}

