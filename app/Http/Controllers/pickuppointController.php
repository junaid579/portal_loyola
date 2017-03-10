<?php

namespace App\Http\Controllers;

use App\Http\Models\transportPickupModel;
use App\Http\Models\transportTermBreakUpModel;

use DB;
use Illuminate\Http\Request;
use Session;

class pickuppointController extends Controller {

	public function index() {
		$pickuppoint = new transportPickupModel;
		$transportpickup = $pickuppoint->getTransportPickupTerms();
		$search_data = array(
			'search_pickuppoint' => "",
			'search_twowayfee'   => "",
			'search_onewayfee'   => "",
			'search_noofterms'   => "",
			'search_status'   => "",
		);
       	return view('transportpickuppointfee')->with(compact('transportpickup'))->with($search_data);
	}

	public function findAction(Request $request) {
		if ($request->has('insert_submit')) {
			$pickuppoint = new transportPickupModel;
			$no_of_terms = $request->no_of_terms;
			$pickup_id = $pickuppoint->datainsert($request);
			if($pickup_id){
				$pickupterms = new transportTermBreakUpModel;
				$inserted = $pickupterms->datainsert($request,$pickup_id);
				if($inserted){
					Session::flash('message', 'Pickup Point '.$request->pickup_point_name.' successfully added');		
				}else{
					Session::flash('error_message', 'Something went wrong! Try again!');
				}	
			}else{
				Session::flash('error_message', 'Something went wrong! Try again!');
			}
			return redirect('/transportpickuppointfee');
		} else if ($request->has('search_submit')) {
			$pickuppoint = new transportPickupModel;
			$search_data = array(
				'search_pickuppoint' => $request->search_pickuppoint,
				'search_twowayfee' => $request->search_twowayfee,
				'search_onewayfee' => $request->search_onewayfee,
				'search_noofterms' => $request->search_noofterms,
				'search_status' => $request->search_status
			);
			$transportpickup = $pickuppoint->getTransportPickupTermsSearch($search_data);
			return view('transportpickuppointfee')->with(compact('transportpickup'))->with($search_data);
		}
	}
	
	public function update(Request $request){
		$pickuppoint = new transportPickupModel;
		$no_of_terms = $request->no_of_terms;
		$pickup_id = $pickuppoint->dataUpdate($request);
		if($pickup_id){
			$pickupterms = new transportTermBreakUpModel;
			$inserted = $pickupterms->dataUpdate($request,$pickup_id);
			if($inserted){
				Session::flash('message', 'Pickup Point '.$request->pickup_point_name.' successfully updated');		
			}else{
				Session::flash('error_message', 'Something went wrong! Try again!');
			}	
		}else{
			Session::flash('error_message', 'Something went wrong! Try again!');
		}
		return redirect('/transportpickuppointfee');
	}

	public function statusupdate($id, $status) {
		$pickuppoint = new transportPickupModel;
		$status_updated = $pickuppoint->pickupStatusUpdate($id,$status);
		
		if ($status == 1) {
			$status_t = "Activated";
		} else if ($status == 2) {
			$status_t = "Suspended";
		} else if ($status == 0) {
			$status_t = "Deleted";
		}

		if ($status_updated) {
			Session::flash('message', 'Pickup point '.$status_updated.' suscessfully '.$status_t);
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}
		return redirect('/transportpickuppointfee');
	}
		
}
