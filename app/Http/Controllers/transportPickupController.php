<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\transportPickupModel;

use Session;
use Config;
use DB;

class transportPickupController extends Controller
{
    
    public function index(){
    	$allpickups = transportPickupModel::all()->where('status','!=',0);
    	$data = array('allpickups'=>$allpickups);
        return view('transportPickup')->with($data);
    } 

    public function insert(Request $request){
     	$this->validate($request, [
       	 	'pick_point' => 'required',
            'cost' => 'required',
            'one_cost' => 'required',
            'terms' => 'required'
    	]);

    	$tpckup = new transportPickupModel;
    	$tpckup->pickup_point_name = $request->pick_point;
    	$tpckup->cost = $request->cost;
    	$tpckup->one_way_cost = $request->one_cost;
        $tpckup->no_of_terms = $request->terms;
        $tpckup->status = 1;
    	$tpckup->c_on = DB::raw('NOW()');
    	$tpckup->c_by = Session::get('userid');
    	$tpckup->m_on = DB::raw('NOW()');
    	$tpckup->m_by = Session::get('userid');
	
    	if($tpckup->save()){
    		Session::flash('message', 'Pick up point  '. $tpckup->pickup_point_name .' successfully added');
    	}else{
    		Session::flash('error_message', 'Something went wrong! Try again!');
    	}
        return redirect('/transportPickup');
    }

    public function update(Request $request){


       $this->validate($request, [
            'edit_pick_point' => 'required',
            'edit_cost' => 'required',
            'edit_one_cost' => 'required',
            'edit_terms' => 'required'
            ]);
        $tpckup = transportPickupModel::find($request->edit_id);
        $tpckup->pickup_point_name = $request->edit_pick_point;
        $tpckup->cost = $request->edit_cost;
        $tpckup->one_way_cost = $request->edit_one_cost;
        $tpckup->no_of_terms = $request->edit_terms;
        $tpckup->m_on = DB::raw('NOW()');
        $tpckup->m_by = Session::get('userid');

        if($tpckup->save()){
            Session::flash('message', 'Pick up point '. $tpckup->pickup_point_name .' successfully Updated');
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/transportPickup');
    } 
    public function statusupdate($id,$status){
        $tpckup = transportPickupModel::find($id);
        $tpckup->m_on = DB::raw('NOW()');
        $tpckup->m_by = Session::get('userid');
        $tpckup->status = $status;

        if($status == 1){ $status_t = "Activated"; }
        else if($status == 2){ $status_t = "Suspended"; }
        else if($status == 0){ $status_t = "Deleted"; }

        if($tpckup->save()){
            Session::flash('message', 'Pick up point '. $tpckup->pickup_point_name .' suscessfully ' .$status_t);
        }else{
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/transportPickup');
    }
  
}

