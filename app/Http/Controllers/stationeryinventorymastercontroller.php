<?php

namespace App\Http\Controllers;

use App\Http\Models\stationeryinventorymasterModel;

use DB;
use Illuminate\Http\Request;
use Session;

class stationeryinventorymasterController extends Controller {

    public function index() {
        $allstationeryinventorymasters = stationeryinventorymasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_inventory_desc'     => "",
            'search_status'    => "",
        );
        return view('stationeryinventorymaster')->with(compact(
            'allstationeryinventorymasters'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'inventory_desc'   => 'required'
            ]);

            $sim               = new stationeryinventorymasterModel;
            $sim->inventory_desc = $request->inventory_desc;
            $sim->status       = 1;
            $sim->c_on         = DB::raw('NOW()');
            $sim->c_by         = Session::get('userid');
            $sim->m_on         = DB::raw('NOW()');
            $sim->m_by         = Session::get('userid');

            if ($sim->save()) {
                Session::flash('message', 'Occupation '. $sim->inventory_desc.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/stationeryinventorymaster');

        } else if ($request->has('search_submit')) {

            $s_inventory_desc     = $request->search_inventory_desc;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_inventory_desc'     => $s_inventory_desc,
                'search_status'    => $s_status,
            );

            $query = stationeryinventorymasterModel::select('*');

            if ($s_inventory_desc != "") {$query     = $query->where('inventory_desc', 'like',"%".$s_inventory_desc."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allstationeryinventorymasters = $query->get();



            return view('stationeryinventorymaster')->with(compact(
                'allstationeryinventorymasters'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_inventory_desc'   => 'required'
        ]);
        $sim               = stationeryinventorymasterModel::find($request->edit_id);
        $sim->inventory_desc = $request->edit_inventory_desc;
        $sim->m_on         = DB::raw('NOW()');
        $sim->m_by         = Session::get('userid');

        if ($sim->save()) {
            Session::flash('message', 'Occupation '. $sim->inventory_desc.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/stationeryinventorymaster');
    }
    public function statusupdate($id, $status) {
        $sim         = stationeryinventorymasterModel::find($id);
        $sim->m_on   = DB::raw('NOW()');
        $sim->m_by   = Session::get('userid');
        $sim->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($sim->save()) {
            Session::flash('message','Occupation '. $sim->inventory_desc.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/stationeryinventorymaster');
    }

    public function search(Request $request) {

    }

}
