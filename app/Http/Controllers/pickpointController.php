<?php

namespace App\Http\Controllers;

use App\Http\Models\pickpointModel;

use DB;
use Illuminate\Http\Request;
use Session;

class pickpointController extends Controller {

    public function index() {
        $allpickpoint = pickpointModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_pickup_point_name'     => "",
            'search_cost'   => "",
            'search_one_way_cost'   => "",
            'search_no_of_terms'   => "",
            'search_status'    => "",
        );
        return view('pickpoint')->with(compact(
            'allpickpoint'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'pickup_point_name'   => 'required',
                'cost'   => 'required',
                'one_way_cost'   => 'required',
                'no_of_terms'   => 'required',
            ]);

            $stf               = new pickpointModel;
            $stf->pickup_point_name = $request->pickup_point_name;
            $stf->cost = $request->cost;
            $stf->one_way_cost = $request->one_way_cost;
            $stf->no_of_terms = $request->no_of_terms;
            $stf->status       = 1;
            $stf->c_on         = DB::raw('NOW()');
            $stf->c_by         = Session::get('userid');
            $stf->m_on         = DB::raw('NOW()');
            $stf->m_by         = Session::get('userid');

            if ($stf->save()) {
                Session::flash('message', 'Pick Point '.$stf->pickup_point_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/pickpoint');

        } else if ($request->has('search_submit')) {

            $s_pickup_point_name     = $request->search_pickup_point_name;
            $s_cost   = $request->search_cost;
            $s_one_way_cost   = $request->search_one_way_cost;
            $s_no_of_terms  = $request->search_no_of_terms;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_pickup_point_name'     => $s_pickup_point_name,
                'search_cost'   => $s_cost,
                'search_one_way_cost'   => $s_one_way_cost,
                'search_no_of_terms'   => $s_no_of_terms,
                'search_status'    => $s_status,
            );

            $query = pickpointModel::select('*');

            if ($s_pickup_point_name != "") {$query     = $query->where('pickup_point_name', 'like',"%".$s_pickup_point_name."%");}
            if ($s_cost != "") {$query   = $query->where('cost', 'like',"%".$s_cost."%");}
            if ($s_one_way_cost != "") {$query   = $query->where('one_way_cost', 'like',"%".$s_one_way_cost."%");}
            if ($s_no_of_terms != "") {$query   = $query->where('no_of_terms', 'like',"%".$s_no_of_terms."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allpickpoint = $query->get();



            return view('pickpoint')->with(compact(
                'allpickpoint'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_pickup_point_name'   => 'required',
            'edit_cost'   => 'required',
            'edit_one_way_cost'   => 'required',
            'edit_no_of_terms'   => 'required',
            'edit_section'   => 'required'
        ]);
        $stf               = pickpointModel::find($request->edit_id);
        $stf->pickup_point_name = $request->edit_pickup_point_name;
        $stf->cost     = $request->edit_cost;
        $stf->one_way_cost = $request->edit_one_way_cost;
        $stf->no_of_terms     = $request->edit_no_of_terms;
        $stf->m_on         = DB::raw('NOW()');
        $stf->m_by         = Session::get('userid');

        if ($stf->save()) {
            Session::flash('message', 'Pick Point '.$stf->pickup_point_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/pickpoint');
    }
    public function statusupdate($id, $status) {
        $stf         = pickpointModel::find($id);
        $stf->m_on   = DB::raw('NOW()');
        $stf->m_by   = Session::get('userid');
        $stf->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($stf->save()) {
            Session::flash('message', 'Pick Point '.$stf->pickup_point_name.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/pickpoint');
    }

    public function search(Request $request) {

    }

}
