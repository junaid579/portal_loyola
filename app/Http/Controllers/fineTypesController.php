<?php

namespace App\Http\Controllers;

use App\Http\Models\fineTypesModel;

use DB;
use Illuminate\Http\Request;
use Session;

class fineTypesController extends Controller {

    public function index() {
        $allfineTypes = fineTypesModel::all()->where('status', '!=', 0);

        $search_data = array(
            'search_fine_name'     => "",
            'search_heading_on_bill' => "",
            'search_status'    => "",
        );
        return view('finetypes')->with(compact(
            'allfineTypes'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'fine_name'   => 'required',
                'heading_on_bill' => 'required'
            ]);

            $fnty               = new fineTypesModel;
            $fnty->fine_name = $request->fine_name;
            $fnty->heading_on_bill = $request->heading_on_bill;
            $fnty->status       = 1;
            $fnty->c_on         = DB::raw('NOW()');
            $fnty->c_by         = Session::get('userid');
            $fnty->m_on         = DB::raw('NOW()');
            $fnty->m_by         = Session::get('userid');

            if ($fnty->save()) {
                Session::flash('message', 'fine Type '. $fnty->fine_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/finetypes');

        } else if ($request->has('search_submit')) {

            $s_fine_name     = $request->search_fine_name;
            $s_heading_on_bill     = $request->search_heading_on_bill;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_fine_name'     => $s_fine_name,
                'search_heading_on_bill'     => $s_heading_on_bill,
                'search_status'    => $s_status,
            );

            $query = fineTypesModel::select('*');

            if ($s_fine_name != "") {$query     = $query->where('fine_name', 'like',"%".$s_fine_name."%");}
            if ($s_heading_on_bill != "") {$query     = $query->where('heading_on_bill', 'like',"%".$s_heading_on_bill."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allfineTypes = $query->get();



            return view('finetypes')->with(compact(
                'allfineTypes'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_fine_name'   => 'required',
            'edit_heading_on_bill'   => 'required',
        ]);
        $fnty               = fineTypesModel::find($request->edit_id);
        $fnty->fine_name = $request->edit_fine_name;
        $fnty->heading_on_bill     = $request->edit_heading_on_bill;
        $fnty->m_on         = DB::raw('NOW()');
        $fnty->m_by         = Session::get('userid');

        if ($fnty->save()) {
            Session::flash('message', 'Occupation '. $fnty->fine_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/finetypes');
    }
    public function statusupdate($id, $status) {
        $fnty         = fineTypesModel::find($id);
        $fnty->m_on   = DB::raw('NOW()');
        $fnty->m_by   = Session::get('userid');
        $fnty->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($fnty->save()) {
            Session::flash('message','Occupation '. $fnty->fine_name.' successfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/finetypes');
    }

    public function search(Request $request) {

    }

}
