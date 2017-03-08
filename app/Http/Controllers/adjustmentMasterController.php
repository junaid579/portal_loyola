<?php

namespace App\Http\Controllers;

use App\Http\Models\adjustmentMasterModel;

use DB;
use Illuminate\Http\Request;
use Session;

class adjustmentMasterController extends Controller {

    public function index() {
        $alladjustmentMaster = adjustmentMasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_adjustment_reason'     => "",
            'search_status'    => ""
        );
        return view('adjustmentmaster')->with(compact(
            'alladjustmentMaster'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'adjustment_reason'   => 'required',
            ]);

            $fadj               = new adjustmentMasterModel;
            $fadj->adjustment_reason = $request->adjustment_reason;
            $fadj->status       = 1;
            $fadj->c_on         = DB::raw('NOW()');
            $fadj->c_by         = Session::get('userid');
            $fadj->m_on         = DB::raw('NOW()');
            $fadj->m_by         = Session::get('userid');

            if ($fadj->save()) {
                Session::flash('message', 'Fee Adjustment '.$fadj->adjustment_reason.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('adjustmentmaster');

        } else if ($request->has('search_submit')) {

            $s_adjustment_reason     = $request->search_adjustment_reason;
            $s_status    = $request->search_status;


            $search_data = array(
                'search_adjustment_reason'     => $s_adjustment_reason,
                'search_status'    => $s_status,

            );

            $query = adjustmentMasterModel::select('*');

            if ($s_adjustment_reason != "") {$query     = $query->where('adjustment_reason', 'like',"%".$s_adjustment_reason."%");}
      


            return view('adjustmentmaster')->with(compact(
                'alladjustmentMaster'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_adjustment_reason'   => 'required',
        ]);
        $fadj               = adjustmentMasterModel::find($request->edit_id);
        $fadj->adjustment_reason = $request->edit_adjustment_reason;
        $fadj->m_on         = DB::raw('NOW()');
        $fadj->m_by         = Session::get('userid');

        if ($fadj->save()) {
            Session::flash('message', 'Fee Adjustment'.$fadj->adjustment_reason.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('adjustmentmaster');
    }
    public function statusupdate($id, $status) {
        $fadj         = adjustmentMasterModel::find($id);
        $fadj->m_on   = DB::raw('NOW()');
        $fadj->m_by   = Session::get('userid');
        $fadj->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($fadj->save()) {
            Session::flash('message', 'Fee Adjustment'.$fadj->adjustment_reason.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('adjustmentmaster');
    }

    public function search(Request $request) {

    }

}
