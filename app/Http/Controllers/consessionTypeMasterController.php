<?php

namespace App\Http\Controllers;

use App\Http\Models\consessionTypeMasterModel;

use DB;
use Illuminate\Http\Request;
use Session;

class consessionTypeMasterController extends Controller {

    public function index() {
        $allconsessionType = consessionTypeMasterModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_consession_desc'     => "",
            'search_status'    => "",
        );
        return view('consessiontypemaster')->with(compact(
            'allconsessionType'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'consession_desc'   => 'required'
            ]);

            $cnsn              = new consessionTypeMasterModel;
            $cnsn ->consession_desc = $request->consession_desc;
            $cnsn ->status       = 1;
            $cnsn ->c_on         = DB::raw('NOW()');
            $cnsn ->c_by         = Session::get('userid');
            $cnsn ->m_on         = DB::raw('NOW()');
            $cnsn ->m_by         = Session::get('userid');

            if ($cnsn ->save()) {
                Session::flash('message', 'Consession Type '. $cnsn ->consession_desc.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/consessiontypemaster');

        } else if ($request->has('search_submit')) {

            $s_consession_desc     = $request->search_consession_desc;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_consession_desc'     => $s_consession_desc,
                'search_status'    => $s_status,
            );

            $query = consessionTypeMasterModel::select('*');

            if ($s_consession_desc != "") {$query     = $query->where('consession_desc', 'like',"%".$s_consession_desc."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allconsessionType = $query->get();



            return view('consessiontypemaster')->with(compact(
                'allconsessionType'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_consession_desc'   => 'required'
        ]);
        $cnsn              = consessionTypeMasterModel::find($request->edit_id);
        $cnsn ->consession_desc = $request->edit_consession_desc;
        $cnsn ->m_on         = DB::raw('NOW()');
        $cnsn ->m_by         = Session::get('userid');

        if ($cnsn ->save()) {
            Session::flash('message', 'Consession Type '. $cnsn ->consession_desc.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/consessiontypemaster');
    }
    public function statusupdate($id, $status) {
        $cnsn        = consessionTypeMasterModel::find($id);
        $cnsn ->m_on   = DB::raw('NOW()');
        $cnsn ->m_by   = Session::get('userid');
        $cnsn ->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($cnsn ->save()) {
            Session::flash('message','Consession Type '. $cnsn ->consession_desc.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/consessiontypemaster');
    }

    public function search(Request $request) {

    }

}
