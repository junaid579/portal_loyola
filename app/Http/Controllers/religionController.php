<?php

namespace App\Http\Controllers;

use App\Http\Models\religionModel;

use DB;
use Illuminate\Http\Request;
use Session;

class religionController extends Controller {

    public function index() {
        $allreligions = religionModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_religion_name'     => "",
            'search_status'    => "",
        );
        return view('religion')->with(compact(
            'allreligions'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'religion_name'   => 'required'
            ]);

            $rlgn               = new religionModel;
            $rlgn->religion_name = $request->religion_name;
            $rlgn->status       = 1;
            $rlgn->c_on         = DB::raw('NOW()');
            $rlgn->c_by         = Session::get('userid');
            $rlgn->m_on         = DB::raw('NOW()');
            $rlgn->m_by         = Session::get('userid');

            if ($rlgn->save()) {
                Session::flash('message', 'Religion Name '. $rlgn->religion_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/religion');

        } else if ($request->has('search_submit')) {

            $s_religion_name     = $request->search_religion_name;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_religion_name'     => $s_religion_name,
                'search_status'    => $s_status,
            );

            $query = religionModel::select('*');

            if ($s_religion_name != "") {$query     = $query->where('religion_name', 'like',"%".$s_religion_name."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allreligions = $query->get();



            return view('religion')->with(compact(
                'allreligions'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_religion_name'   => 'required',
        ]);
        $rlgn               = religionModel::find($request->edit_id);
        $rlgn->religion_name = $request->edit_religion_name;
        $rlgn->m_on         = DB::raw('NOW()');
        $rlgn->m_by         = Session::get('userid');

        if ($rlgn->save()) {
            Session::flash('message','Religion Name '. $rlgn->religion_name.'successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/religion');
    }
    public function statusupdate($id, $status) {
        $rlgn         = religionModel::find($id);
        $rlgn->m_on   = DB::raw('NOW()');
        $rlgn->m_by   = Session::get('userid');
        $rlgn->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($rlgn->save()) {
            Session::flash('message','Religion Name '. $rlgn->religion_name.'successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/religion');
    }

    public function search(Request $request) {

    }

}
