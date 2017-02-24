<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\classesModel;

use Session;
use Config;
use DB;

class classesController extends Controller
{
    
    public function index(){
        $allclasses = classesModel::all()->where('status','!=',0)->sortByDesc("sequences");
        
        // $classes = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        
        //Data arrays
        //$data_class = array('classes'=>$classes);
        //$data = array('allsections'=>$allsections);
        //return view('sections')->with($data)->with($data_class);
        return view('classes') -> with(compact('allclasses'));
    } 

    public function insert(Request $request){

        $this->validate($request, [
            'class' => 'required',
            'sequences' => 'required'
        ]);

        $cls = new classesModel;
        $cls->sequence = $request->sequences;
        $cls->class_name = $request->class;
        $cls->status = 1;
        $cls->c_on = DB::raw('NOW()');
        $cls->c_by = Session::get('userid');
        $cls->m_on = DB::raw('NOW()');
        $cls->m_by = Session::get('userid');
    
        if($cls->save()){
            Session::flash('message', 'Class '. $cls->class_name .' successfully added');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/classes');
    }

    public function update(Request $request){


       $this->validate($request, [
            'edit_id' => 'required',
            'edit_class' => 'required',
            'edit_sequences' => 'required',
            ]);
        $cls = classesModel::find($request->edit_id);
        $cls->section_name = $request->edit_section;
        $cls->class_id = $request->edit_classes;
        $cls->sequence = $request->edit_sequences;
        $cls->m_on = DB::raw('NOW()');
        $cls->m_by = Session::get('userid');

        if($cls->save()){
            Session::flash('message', 'Section '. $cls->section_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/classes');
    } 
    public function statusupdate($id,$status){
        $cls = classesModel::find($id);
        $cls->m_on = DB::raw('NOW()');
        $cls->m_by = Session::get('userid');
        $cls->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($cls->save()){
            Session::flash('message', 'Section '. $cls->class_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/classes');
    }
    public function dashboard(){
        $allsections = classesModel::all()->where('status','=',1);
        $data = array('allsections'=>$allsections);
        $allclasses = classesModel::all()->where('status','=',1)->sortByDesc("sequences");
        $data_class = array('allclasses'=>$allclasses);
        return view('/dashboard')->with($data)->with($data_class);
    } 
  
}

