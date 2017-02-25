<?php

namespace App\Http\Controllers;

use App\Http\Models\casteModel;

use DB;
use Illuminate\Http\Request;
use Session;

class casteController extends Controller {

    public function index() {
        $allcastes = casteModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_caste_name'     => "",
            'search_caste_code' => "",
            'search_status'    => "",
        );
        return view('caste')->with(compact(
            'allcastes'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'caste_name'   => 'required',
                'caste_code' => 'required'
            ]);

            $caste               = new casteModel;
            $caste->caste_name = $request->caste_name;
            $caste->caste_code = $request->caste_code;
            $caste->status       = 1;
            $caste->c_on         = DB::raw('NOW()');
            $caste->c_by         = Session::get('userid');
            $caste->m_on         = DB::raw('NOW()');
            $caste->m_by         = Session::get('userid');

            if ($caste->save()) {
                Session::flash('message', 'Caste Name '. $caste->caste_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/caste');

        } else if ($request->has('search_submit')) {

            $s_caste_name     = $request->search_caste_name;
            $s_caste_code     = $request->search_caste_code;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_caste_name'     => $s_caste_name,
                'search_caste_code'     => $s_caste_code,
                'search_status'    => $s_status,
            );

            $query = casteModel::select('*');

            if ($s_caste_name != "") {$query     = $query->where('caste_name', 'like',"%".$s_caste_name."%");}
            if ($s_caste_code != "") {$query     = $query->where('caste_code', 'like',"%".$s_caste_code."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allcastes = $query->get();



            return view('caste')->with(compact(
                'allcastes'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_caste_name'   => 'required',
            'edit_caste_code'   => 'required',
        ]);
        $caste               = casteModel::find($request->edit_id);
        $caste->caste_name = $request->edit_caste_name;
        $caste->caste_code     = $request->edit_caste_code;
        $caste->m_on         = DB::raw('NOW()');
        $caste->m_by         = Session::get('userid');

        if ($caste->save()) {
            Session::flash('message','Caste Name '. $caste->caste_name.'successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/caste');
    }
    public function statusupdate($id, $status) {
        $caste         = casteModel::find($id);
        $caste->m_on   = DB::raw('NOW()');
        $caste->m_by   = Session::get('userid');
        $caste->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($caste->save()) {
            Session::flash('message','Caste Name '. $caste->caste_name.'successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/caste');
    }

    public function search(Request $request) {

    }

}
