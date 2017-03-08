<?php

namespace App\Http\Controllers;

use App\Http\Models\countriesModel;

use DB;
use Illuminate\Http\Request;
use Session;

class countriesController extends Controller {

    public function index() {
        $allcountriess = countriesModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_countries_name'     => "",
            'search_countries_code' => "",
            'search_status'    => "",
        );
        return view('countriess')->with(compact(
            'allcountriess'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'countries_name'   => 'required',
                'countries_code' => 'required'
            ]);

            $countriess               = new countriesModel;
            $countriess->countries_name = $request->countries_name;
            $countriess->countries_code = $request->countries_code;
            $countriess->status       = 1;
            $countriess->c_on         = DB::raw('NOW()');
            $countriess->c_by         = Session::get('userid');
            $countriess->m_on         = DB::raw('NOW()');
            $countriess->m_by         = Session::get('userid');

            if ($countriess->save()) {
                Session::flash('message', 'Caste Name '. $countriess->countries_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/countriess');

        } else if ($request->has('search_submit')) {

            $s_countries_name     = $request->search_countries_name;
            $s_countries_code     = $request->search_countries_code;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_countries_name'     => $s_countries_name,
                'search_countries_code'     => $s_countries_code,
                'search_status'    => $s_status,
            );

            $query = countriesModel::select('*');

            if ($s_countries_name != "") {$query     = $query->where('countries_name', 'like',"%".$s_countries_name."%");}
            if ($s_countries_code != "") {$query     = $query->where('countries_code', 'like',"%".$s_countries_code."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allcountriess = $query->get();



            return view('countriess')->with(compact(
                'allcountriess'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_countries_name'   => 'required',
            'edit_countries_code'   => 'required',
        ]);
        $countriess               = countriesModel::find($request->edit_id);
        $countriess->countries_name = $request->edit_countries_name;
        $countriess->countries_code     = $request->edit_countries_code;
        $countriess->m_on         = DB::raw('NOW()');
        $countriess->m_by         = Session::get('userid');

        if ($countriess->save()) {
            Session::flash('message','Caste Name '. $countriess->countries_name.'successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/countriess');
    }
    public function statusupdate($id, $status) {
        $countriess         = countriesModel::find($id);
        $countriess->m_on   = DB::raw('NOW()');
        $countriess->m_by   = Session::get('userid');
        $countriess->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($countriess->save()) {
            Session::flash('message','Caste Name '. $countriess->countries_name.'successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/countriess');
    }

    public function search(Request $request) {

    }

}
