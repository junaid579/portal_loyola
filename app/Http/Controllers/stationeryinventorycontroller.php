<?php

namespace App\Http\Controllers;

use App\Http\Models\stationeryinventorymasterModel;
use App\Http\Models\stationeryMasterModel;
use App\Http\Models\stationeryinventoryModel;

use DB;
use Illuminate\Http\Request;
use Session;

class stationeryinventoryController extends Controller {

    public function index() {
        $allstationeryInventory = stationeryinventoryModel::all()->where('status', '!=', 0);
        $stationeryInventoryMasters = stationeryinventorymasterModel::all()->where('status', '=', 1);
        $stationeryItems = stationeryMasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_stationeryInventoryMaster'     => "",
            'search_stationeryItem'   => "",
            'search_count' => "",
            'search_status'    => "",
        );
        return view('stationeryinventory')->with(compact(
            'allstationeryInventory',
            'stationeryInventoryMasters',
            'stationeryItems'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'inventory_id'  => 'required',
                'item_id'  => 'required',
                'count' => 'required'
            ]);

            $stg               = new stationeryinventoryModel;
            $stg->inventory_id = $request->inventory_id;
            $stg->item_id     = $request->item_id;
            $stg->count     = $request->count;
            $stg->status       = 1;
            $stg->c_on         = DB::raw('NOW()');
            $stg->c_by         = Session::get('userid');
            $stg->m_on         = DB::raw('NOW()');
            $stg->m_by         = Session::get('userid');

            if ($stg->save()) {
                Session::flash('message', 'Stationery Group '.$stg->inventory_id.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/stationeryinventory');

        } else if ($request->has('search_submit')) {

            $s_stationeryInventoryMaster     = $request->search_stationeryInventoryMaster;
            $s_stationeryItem   = $request->search_stationeryItem;
            $s_count    = $request->search_count;
            $s_status      = $request->search_status;

            $search_data = array(
                'search_stationeryInventoryMaster'     => $s_stationeryInventoryMaster,
                'search_stationeryItem'   => $s_stationeryItem,
                'search_count' => $s_count,
                'search_status'    => $s_status,
            );

            $query = stationeryinventoryModel::select('*');

            if ($s_stationeryInventoryMaster != "") {$query     = $query->where('inventory_id', 'like',"%".$s_stationeryInventoryMaster."%"  );}
            if ($s_stationeryItem != "") {$query   = $query->where('item_id', 'like',"%". $s_stationeryItem."%");}
            if ($s_count != "") {$query = $query->where('count', 'like',"%". $s_count."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%". $s_status."%");}

            $allstationeryInventory = $query->get();

            $stationeryInventoryMasters = stationeryinventorymasterModel::all()->where('status', '=', 1);
            $stationeryItems = stationeryMasterModel::all()->where('status', '!=', 0);

            return view('stationeryinventory')->with(compact(
                'allstationeryInventory',
                'stationeryInventoryMasters',
                'stationeryItems'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_stationeryInventoryMaster'   => 'required',
            'edit_stationeryItem' => 'required',
            'edit_count'   => 'required'
        ]);
        $stg               = stationeryinventoryModel::find($request->edit_id);
        $stg->inventory_id = $request->edit_stationeryInventoryMaster;
        $stg->item_id     = $request->edit_stationeryItem;
        $stg->count     = $request->edit_count;
        $stg->m_on         = DB::raw('NOW()');
        $stg->m_by         = Session::get('userid');

        if ($stg->save()) {
            Session::flash('message', 'Stationery Group '.$stg->inventory_id.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/stationeryinventory');
    }
    public function statusupdate($id, $status) {
        $stg         = stationeryinventoryModel::find($id);
        $stg->m_on   = DB::raw('NOW()');
        $stg->m_by   = Session::get('userid');
        $stg->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($stg->save()) {
            Session::flash('message', 'Stationery Group '.$stg->inventory_id.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/stationeryinventory');
    }

    public function search(Request $request) {

    }

}
