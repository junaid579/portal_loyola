<?php

namespace App\Http\Controllers;

use App\Http\Models\feeTypesModel;

use DB;
use Illuminate\Http\Request;
use Session;

class feeTypesController extends Controller {

    public function index() {
        $allfeeTypes = feeTypesModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_fee_name'     => "",
            'search_heading_on_bill' => "",
            'search_status'    => "",
        );
        return view('feetypes')->with(compact(
            'allfeeTypes'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'fee_name'   => 'required',
                'heading_on_bill' => 'required'
            ]);

            $fty               = new feeTypesModel;
            $fty->fee_name = $request->fee_name;
            $fty->heading_on_bill = $request->heading_on_bill;
            $fty->status       = 1;
            $fty->c_on         = DB::raw('NOW()');
            $fty->c_by         = Session::get('userid');
            $fty->m_on         = DB::raw('NOW()');
            $fty->m_by         = Session::get('userid');

            if ($fty->save()) {
                Session::flash('message', 'Fee Type '. $fty->fee_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/feetypes');

        } else if ($request->has('search_submit')) {

            $s_fee_name     = $request->search_fee_name;
            $s_heading_on_bill     = $request->search_heading_on_bill;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_fee_name'     => $s_fee_name,
                'search_heading_on_bill'     => $s_heading_on_bill,
                'search_status'    => $s_status,
            );

            $query = feeTypesModel::select('*');

            if ($s_fee_name != "") {$query     = $query->where('fee_name', 'like',"%".$s_fee_name."%");}
            if ($s_heading_on_bill != "") {$query     = $query->where('heading_on_bill', 'like',"%".$s_heading_on_bill."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allfeeTypes = $query->get();



            return view('feetypes')->with(compact(
                'allfeeTypes'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_fee_name'   => 'required',
            'edit_heading_on_bill'   => 'required',
        ]);
        $fty               = feeTypesModel::find($request->edit_id);
        $fty->fee_name = $request->edit_fee_name;
        $fty->heading_on_bill     = $request->edit_heading_on_bill;
        $fty->m_on         = DB::raw('NOW()');
        $fty->m_by         = Session::get('userid');

        if ($fty->save()) {
            Session::flash('message', 'Fee Type '. $fty->fee_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/feetypes');
    }
    public function statusupdate($id, $status) {
        $fty         = feeTypesModel::find($id);
        $fty->m_on   = DB::raw('NOW()');
        $fty->m_by   = Session::get('userid');
        $fty->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($fty->save()) {
            Session::flash('message','Fee Type '. $fty->fee_name.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/feetypes');
    }

    public function search(Request $request) {

    }

}
