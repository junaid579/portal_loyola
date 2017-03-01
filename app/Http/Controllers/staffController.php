<?php

namespace App\Http\Controllers;

use App\Http\Models\staffModel;

use DB;
use Illuminate\Http\Request;
use Session;

class staffController extends Controller {

    public function index() {
        $allstaff = staffModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_f_name'     => "",
            'search_l_name'   => "",
            'search_mobile'   => "",
            'search_email'   => "",
            'search_status'    => "",
        );
        return view('staff')->with(compact(
            'allstaff'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'f_name'   => 'required',
                'l_name'   => 'required',
                'mobile'   => 'required',
                'email'   => 'required',
            ]);

            $stf               = new staffModel;
            $stf->f_name = $request->f_name;
            $stf->l_name = $request->l_name;
            $stf->mobile = $request->mobile;
            $stf->email = $request->email;
            $stf->status       = 1;
            $stf->c_on         = DB::raw('NOW()');
            $stf->c_by         = Session::get('userid');
            $stf->m_on         = DB::raw('NOW()');
            $stf->m_by         = Session::get('userid');

            if ($stf->save()) {
                Session::flash('message', 'Staff Member '.$stf->f_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/staff');

        } else if ($request->has('search_submit')) {

            $s_f_name     = $request->search_f_name;
            $s_l_name   = $request->search_l_name;
            $s_mobile   = $request->search_mobile;
            $s_email  = $request->search_email;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_f_name'     => $s_f_name,
                'search_l_name'   => $s_l_name,
                'search_mobile'   => $s_mobile,
                'search_email'   => $s_email,
                'search_status'    => $s_status,
            );

            $query = staffModel::select('*');

            if ($s_f_name != "") {$query     = $query->where('f_name', 'like',"%".$s_f_name."%");}
            if ($s_l_name != "") {$query   = $query->where('l_name', 'like',"%".$s_l_name."%");}
            if ($s_mobile != "") {$query   = $query->where('mobile', 'like',"%".$s_mobile."%");}
            if ($s_email != "") {$query   = $query->where('email', 'like',"%".$s_email."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allstaff = $query->get();



            return view('staff')->with(compact(
                'allstaff'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_f_name'   => 'required',
            'edit_l_name'   => 'required',
            'edit_mobile'   => 'required',
            'edit_email'   => 'required',
            'edit_section'   => 'required'
        ]);
        $stf               = staffModel::find($request->edit_id);
        $stf->f_name = $request->edit_f_name;
        $stf->l_name     = $request->edit_l_name;
        $stf->mobile = $request->edit_mobile;
        $stf->email     = $request->edit_email;
        $stf->m_on         = DB::raw('NOW()');
        $stf->m_by         = Session::get('userid');

        if ($stf->save()) {
            Session::flash('message', 'satff Member '.$stf->f_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/staff');
    }
    public function statusupdate($id, $status) {
        $stf         = staffModel::find($id);
        $stf->m_on   = DB::raw('NOW()');
        $stf->m_by   = Session::get('userid');
        $stf->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($stf->save()) {
            Session::flash('message', 'satff Member '.$stf->f_name.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/staff');
    }

    public function search(Request $request) {

    }

}
