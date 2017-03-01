<?php

namespace App\Http\Controllers;

use App\Http\Models\stationeryGroupMasterModel;

use DB;
use Illuminate\Http\Request;
use Session;

class stationeryGroupMasterController extends Controller {

    public function index() {
        $allstationeryGroup = stationeryGroupMasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_group_name'     => "",
            'search_status'    => "",
        );
        return view('stationerygroupmaster')->with(compact(
            'allstationeryGroup'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'group_name'   => 'required'
            ]);

            $sgm              = new stationeryGroupMasterModel;
            $sgm ->group_name = $request->group_name;
            $sgm ->status       = 1;
            $sgm ->c_on         = DB::raw('NOW()');
            $sgm ->c_by         = Session::get('userid');
            $sgm ->m_on         = DB::raw('NOW()');
            $sgm ->m_by         = Session::get('userid');

            if ($sgm ->save()) {
                Session::flash('message', 'Stationery Group '. $sgm ->group_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/stationerygroupmaster');

        } else if ($request->has('search_submit')) {

            $s_group_name     = $request->search_group_name;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_group_name'     => $s_group_name,
                'search_status'    => $s_status,
            );

            $query = stationeryGroupMasterModel::select('*');

            if ($s_group_name != "") {$query     = $query->where('group_name', 'like',"%".$s_group_name."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allstationeryGroup = $query->get();



            return view('stationerygroupmaster')->with(compact(
                'allstationeryGroup'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_group_name'   => 'required'
        ]);
        $sgm              = stationeryGroupMasterModel::find($request->edit_id);
        $sgm ->group_name = $request->edit_group_name;
        $sgm ->m_on         = DB::raw('NOW()');
        $sgm ->m_by         = Session::get('userid');

        if ($sgm ->save()) {
            Session::flash('message', 'Stationery Group '. $sgm ->group_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/stationerygroupmaster');
    }
    public function statusupdate($id, $status) {
        $sgm        = stationeryGroupMasterModel::find($id);
        $sgm ->m_on   = DB::raw('NOW()');
        $sgm ->m_by   = Session::get('userid');
        $sgm ->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($sgm ->save()) {
            Session::flash('message','Stationery Group '. $sgm ->group_name.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/stationerygroupmaster');
    }

    public function search(Request $request) {

    }

}
