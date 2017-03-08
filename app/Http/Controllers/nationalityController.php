<?php

namespace App\Http\Controllers;

use App\Http\Models\nationalityModel;

use DB;
use Illuminate\Http\Request;
use Session;

class nationalityController extends Controller {

    public function index() {
        $allnationalities = nationalityModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_nationality'     => "",
            'search_status'    => "",
        );
        return view('nationality')->with(compact(
            'allnationalities'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'nationality'   => 'required'
            ]);

            $rlgn               = new nationalityModel;
            $rlgn->nationality = $request->nationality;
            $rlgn->status       = 1;
            $rlgn->c_on         = DB::raw('NOW()');
            $rlgn->c_by         = Session::get('userid');
            $rlgn->m_on         = DB::raw('NOW()');
            $rlgn->m_by         = Session::get('userid');

            if ($rlgn->save()) {
                Session::flash('message', 'Nationality '. $rlgn->nationality.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/nationality');

        } else if ($request->has('search_submit')) {

            $s_nationality     = $request->search_nationality;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_nationality'     => $s_nationality,
                'search_status'    => $s_status,
            );

            $query = nationalityModel::select('*');

            if ($s_nationality != "") {$query     = $query->where('nationality', 'like',"%".$s_nationality."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allnationalities = $query->get();



            return view('nationality')->with(compact(
                'allnationalities'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_nationality'   => 'required',
        ]);
        $rlgn               = nationalityModel::find($request->edit_id);
        $rlgn->nationality = $request->edit_nationality;
        $rlgn->m_on         = DB::raw('NOW()');
        $rlgn->m_by         = Session::get('userid');

        if ($rlgn->save()) {
            Session::flash('message','Nationality '. $rlgn->nationality.'successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/nationality');
    }
    public function statusupdate($id, $status) {
        $rlgn         = nationalityModel::find($id);
        $rlgn->m_on   = DB::raw('NOW()');
        $rlgn->m_by   = Session::get('userid');
        $rlgn->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($rlgn->save()) {
            Session::flash('message','Nationality '. $rlgn->nationality.'successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/nationality');
    }

    public function search(Request $request) {

    }

}
