<?php

namespace App\Http\Controllers;

use App\Http\Models\mothertongueModel;

use DB;
use Illuminate\Http\Request;
use Session;

class mothertongueController extends Controller {

    public function index() {
        $alltongues = mothertongueModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_mother_tongue'     => "",
            'search_status'    => "",
        );
        return view('mothertongue')->with(compact(
            'alltongues'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'mother_tongue'   => 'required'
            ]);

            $rlgn               = new mothertongueModel;
            $rlgn->mother_tongue = $request->mother_tongue;
            $rlgn->status       = 1;
            $rlgn->c_on         = DB::raw('NOW()');
            $rlgn->c_by         = Session::get('userid');
            $rlgn->m_on         = DB::raw('NOW()');
            $rlgn->m_by         = Session::get('userid');

            if ($rlgn->save()) {
                Session::flash('message', 'mothertongue Name '. $rlgn->mother_tongue.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/mothertongue');

        } else if ($request->has('search_submit')) {

            $s_mother_tongue     = $request->search_mother_tongue;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_mother_tongue'     => $s_mother_tongue,
                'search_status'    => $s_status,
            );

            $query = mothertongueModel::select('*');

            if ($s_mother_tongue != "") {$query     = $query->where('mother_tongue', 'like',"%".$s_mother_tongue."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $alltongues = $query->get();



            return view('mothertongue')->with(compact(
                'alltongues'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_mother_tongue'   => 'required',
        ]);
        $rlgn               = mothertongueModel::find($request->edit_id);
        $rlgn->mother_tongue = $request->edit_mother_tongue;
        $rlgn->m_on         = DB::raw('NOW()');
        $rlgn->m_by         = Session::get('userid');

        if ($rlgn->save()) {
            Session::flash('message','mothertongue Name '. $rlgn->mother_tongue.'successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/mothertongue');
    }
    public function statusupdate($id, $status) {
        $rlgn         = mothertongueModel::find($id);
        $rlgn->m_on   = DB::raw('NOW()');
        $rlgn->m_by   = Session::get('userid');
        $rlgn->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($rlgn->save()) {
            Session::flash('message','mothertongue Name '. $rlgn->mother_tongue.'successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/mothertongue');
    }

    public function search(Request $request) {

    }

}
