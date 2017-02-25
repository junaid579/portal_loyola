<?php

namespace App\Http\Controllers;

use App\Http\Models\occupationModel;

use DB;
use Illuminate\Http\Request;
use Session;

class occupationController extends Controller {

    public function index() {
        $alloccupations = occupationModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_occupation_details'     => "",
            'search_status'    => "",
        );
        return view('occupation')->with(compact(
            'alloccupations'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'occupation_details'   => 'required'
            ]);

            $occ               = new occupationModel;
            $occ->occupation_details = $request->occupation_details;
            $occ->status       = 1;
            $occ->c_on         = DB::raw('NOW()');
            $occ->c_by         = Session::get('userid');
            $occ->m_on         = DB::raw('NOW()');
            $occ->m_by         = Session::get('userid');

            if ($occ->save()) {
                Session::flash('message', 'Occupation '. $occ->occupation_details.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/occupation');

        } else if ($request->has('search_submit')) {

            $s_occupation_details     = $request->search_occupation_details;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_occupation_details'     => $s_occupation_details,
                'search_status'    => $s_status,
            );

            $query = occupationModel::select('*');

            if ($s_occupation_details != "") {$query     = $query->where('occupation_details', 'like',"%".$s_occupation_details."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $alloccupations = $query->get();



            return view('occupation')->with(compact(
                'alloccupations'
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
        $occ               = occupationModel::find($request->edit_id);
        $occ->f_name = $request->edit_f_name;
        $occ->l_name     = $request->edit_l_name;
        $occ->mobile = $request->edit_mobile;
        $occ->email     = $request->edit_email;
        $occ->m_on         = DB::raw('NOW()');
        $occ->m_by         = Session::get('userid');

        if ($occ->save()) {
            Session::flash('message', 'Occupation '. $occ->occupation_details.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/occupation');
    }
    public function statusupdate($id, $status) {
        $occ         = occupationModel::find($id);
        $occ->m_on   = DB::raw('NOW()');
        $occ->m_by   = Session::get('userid');
        $occ->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($occ->save()) {
            Session::flash('message','Occupation '. $occ->occupation_details.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/occupation');
    }

    public function search(Request $request) {

    }

}
