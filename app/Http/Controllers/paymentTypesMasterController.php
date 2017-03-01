<?php

namespace App\Http\Controllers;

use App\Http\Models\paymentTypesMasterModel;

use DB;
use Illuminate\Http\Request;
use Session;

class paymentTypesMasterController extends Controller {

    public function index() {
        $allpaymentTypes = paymentTypesMasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_payment_desc'     => "",
            'search_status'    => "",
        );
        return view('paymenttypesmaster')->with(compact(
            'allpaymentTypes'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'payment_desc'   => 'required'
            ]);

            $ptm               = new paymentTypesMasterModel;
            $ptm->payment_desc = $request->payment_desc;
            $ptm->status       = 1;
            $ptm->c_on         = DB::raw('NOW()');
            $ptm->c_by         = Session::get('userid');
            $ptm->m_on         = DB::raw('NOW()');
            $ptm->m_by         = Session::get('userid');

            if ($ptm->save()) {
                Session::flash('message', 'Payment Type '. $ptm->payment_desc.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/paymenttypesmaster');

        } else if ($request->has('search_submit')) {

            $s_payment_desc     = $request->search_payment_desc;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_payment_desc'     => $s_payment_desc,
                'search_status'    => $s_status,
            );

            $query = paymentTypesMasterModel::select('*');

            if ($s_payment_desc != "") {$query     = $query->where('payment_desc', 'like',"%".$s_payment_desc."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allpaymentTypes = $query->get();



            return view('paymenttypesmaster')->with(compact(
                'allpaymentTypes'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_payment_desc'   => 'required'
        ]);
        $ptm               = paymentTypesMasterModel::find($request->edit_id);
        $ptm->payment_desc = $request->edit_payment_desc;
        $ptm->m_on         = DB::raw('NOW()');
        $ptm->m_by         = Session::get('userid');

        if ($ptm->save()) {
            Session::flash('message', 'Payment Type '. $ptm->payment_desc.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/paymenttypesmaster');
    }
    public function statusupdate($id, $status) {
        $ptm         = paymentTypesMasterModel::find($id);
        $ptm->m_on   = DB::raw('NOW()');
        $ptm->m_by   = Session::get('userid');
        $ptm->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($ptm->save()) {
            Session::flash('message','Payment Type '. $ptm->payment_desc.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/paymenttypesmaster');
    }

    public function search(Request $request) {

    }

}
