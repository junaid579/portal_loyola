<?php

namespace App\Http\Controllers;

use App\Http\Models\testtypeModel;

use DB;
use Illuminate\Http\Request;
use Session;

class testtypeController extends Controller {

    public function index() {
        $alltesttypes = testtypeModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_test_type'     => "",
            'search_status'    => "",
        );
        return view('testtype')->with(compact(
            'alltesttypes'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'test_type'   => 'required'
            ]);

            $tty               = new testtypeModel;
            $tty->test_type = $request->test_type;
            $tty->status       = 1;
            $tty->c_on         = DB::raw('NOW()');
            $tty->c_by         = Session::get('userid');
            $tty->m_on         = DB::raw('NOW()');
            $tty->m_by         = Session::get('userid');

            if ($tty->save()) {
                Session::flash('message', 'Test type '. $tty->test_type.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/testtype');

        } else if ($request->has('search_submit')) {

            $s_test_type     = $request->search_test_type;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_test_type'     => $s_test_type,
                'search_status'    => $s_status,
            );

            $query = testtypeModel::select('*');

            if ($s_test_type != "") {$query     = $query->where('test_type', 'like',"%".$s_test_type."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $alltesttypes = $query->get();



            return view('testtype')->with(compact(
                'alltesttypes'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_test_type'   => 'required'
        ]);
        $tty               = testtypeModel::find($request->edit_id);
        $tty->test_type = $request->edit_test_type;
        $tty->m_on         = DB::raw('NOW()');
        $tty->m_by         = Session::get('userid');

        if ($tty->save()) {
            Session::flash('message', 'Test type '. $tty->test_type.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/testtype');
    }
    public function statusupdate($id, $status) {
        $tty         = testtypeModel::find($id);
        $tty->m_on   = DB::raw('NOW()');
        $tty->m_by   = Session::get('userid');
        $tty->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($tty->save()) {
            Session::flash('message','Test type '. $tty->test_type.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/testtype');
    }

    public function search(Request $request) {

    }

}
