<?php

namespace App\Http\Controllers;

use App\Http\Models\stationeryGroupMasterModel;
use App\Http\Models\stationeryMasterModel;
use App\Http\Models\stationeryGroupsModel;

use DB;
use Illuminate\Http\Request;
use Session;

class stationeryGroupsController extends Controller {

    public function index() {
        $allstationeryGroups = stationeryGroupsModel::all()->where('status', '!=', 0);
        $stationeryGroupMasters = stationeryGroupMasterModel::all()->where('status', '=', 1);
        $stationeryItems = stationeryMasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_stationeryGroupMaster'     => "",
            'search_stationeryItem'   => "",
            'search_stationeryGroups' => "",
            'search_quantity' => "",
            'search_status'    => "",
        );
        return view('stationerygroups')->with(compact(
            'allstationeryGroups',
            'stationeryGroupMasters',
            'stationeryItems'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'group_id'  => 'required',
                'stationery_id'  => 'required',
                'quantity' => 'required'
            ]);

            $stg               = new stationeryGroupsModel;
            $stg->group_id = $request->group_id;
            $stg->stationery_id     = $request->stationery_id;
            $stg->quantity     = $request->quantity;
            $stg->status       = 1;
            $stg->c_on         = DB::raw('NOW()');
            $stg->c_by         = Session::get('userid');
            $stg->m_on         = DB::raw('NOW()');
            $stg->m_by         = Session::get('userid');

            if ($stg->save()) {
                Session::flash('message', 'Stationery Group '.$stg->group_id.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/stationerygroups');

        } else if ($request->has('search_submit')) {

            $s_stationeryGroupMaster     = $request->search_stationeryGroupMaster;
            $s_stationeryItem   = $request->search_stationeryItem;
            $s_quantity    = $request->search_quantity;
            $s_status      = $request->search_status;

            $search_data = array(
                'search_stationeryGroupMaster'     => $s_stationeryGroupMaster,
                'search_stationeryItem'   => $s_stationeryItem,
                'search_quantity' => $s_quantity,
                'search_status'    => $s_status,
            );

            $query = stationeryGroupsModel::select('*');

            if ($s_stationeryGroupMaster != "") {$query     = $query->where('group_id', '=', $s_stationeryGroupMaster);}
            if ($s_stationeryItem != "") {$query   = $query->where('stationery_id', '=', $s_stationeryItem);}
            if ($s_quantity != "") {$query = $query->where('quantity', '=', $s_quantity);}
            if ($s_status != "") {$query    = $query->where('status', '=', $s_status);}

            $allstationeryGroups = $query->get();

            $stationeryGroupMasters = stationeryGroupMasterModel::all()->where('status', '=', 1);
            $stationeryItems = stationeryMasterModel::all()->where('status', '!=', 0);

            return view('stationerygroups')->with(compact(
                'allstationeryGroups',
                'stationeryGroupMasters',
                'stationeryItems'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_stationeryGroupMaster'   => 'required',
            'edit_stationeryItem' => 'required',
            'edit_quantity'   => 'required'
        ]);
        $stg               = stationeryGroupsModel::find($request->edit_id);
        $stg->group_id = $request->edit_stationeryGroupMaster;
        $stg->stationery_id     = $request->edit_stationeryItem;
        $stg->quantity     = $request->edit_quantity;
        $stg->m_on         = DB::raw('NOW()');
        $stg->m_by         = Session::get('userid');

        if ($stg->save()) {
            Session::flash('message', 'Stationery Group '.$stg->group_id.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/stationerygroups');
    }
    public function statusupdate($id, $status) {
        $stg         = stationeryGroupsModel::find($id);
        $stg->m_on   = DB::raw('NOW()');
        $stg->m_by   = Session::get('userid');
        $stg->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($stg->save()) {
            Session::flash('message', 'Stationery Group '.$stg->group_id.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/stationerygroups');
    }

    public function search(Request $request) {

    }

}
