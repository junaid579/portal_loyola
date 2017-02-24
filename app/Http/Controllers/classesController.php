<?php

namespace App\Http\Controllers;

use App\Http\Models\classesModel;

use DB;
use Illuminate\Http\Request;
use Session;

class classesController extends Controller {

    public function index() {
        
        $allclasses     = classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");
        $search_data = array(
            'search_class'     => "",
            'search_sequences' => "",
            'search_status'    => "",
        );
        return view('classes')->with(compact(
                'allclasses'
            ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                    'class'   => 'required',
                    'sequences' => 'required'
                ]);

            $cls               = new classesModel;
            $cls->class_name   = $request->class;
            $cls->sequence     = $request->sequences;
            $cls->status       = 1;
            $cls->c_on         = DB::raw('NOW()');
            $cls->c_by         = Session::get('userid');
            $cls->m_on         = DB::raw('NOW()');
            $cls->m_by         = Session::get('userid');

            if ($cls->save()) {
                Session::flash('message', 'Class '.$cls->class_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/classes');

        } else if ($request->has('search_submit')) {

            $s_class     = $request->search_class;
            $s_sequences = $request->search_sequences;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_class'     => $s_class,
                'search_sequences' => $s_sequences,
                'search_status'    => $s_status,
            );

            $query = classesModel::select('*');

            if ($s_class != "") {$query   = $query->where('class_name', '=', $s_class);}
            if ($s_sequences != "") {$query = $query->where('sequence', '=', $s_sequences);}
            if ($s_status != "") {$query    = $query->where('status', '=', $s_status);}

            $allclasses = $query->get();

            

            return view('classes')->with(compact(
                    'allclasses'
                ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
                'edit_id'        => 'required',
                'edit_sequences' => 'required',
                'edit_class'   => 'required'
            ]);
        $cls               = classesModel::find($request->edit_id);
        $cls->class_name = $request->edit_class;
        $cls->sequence     = $request->edit_sequences;
        $cls->m_on         = DB::raw('NOW()');
        $cls->m_by         = Session::get('userid');

        if ($cls->save()) {
            Session::flash('message', 'Class '.$cls->class_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/classes');
    }
    public function statusupdate($id, $status) {
        $cls         = classesModel::find($id);
        $cls->m_on   = DB::raw('NOW()');
        $cls->m_by   = Session::get('userid');
        $cls->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($cls->save()) {
            Session::flash('message', 'Class '.$cls->class_name.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/classes');
    }

    public function search(Request $request) {

    }

}
