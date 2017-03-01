<?php

namespace App\Http\Controllers;

use App\Http\Models\classesModel;
use App\Http\Models\subjectsModel;

use DB;
use Illuminate\Http\Request;
use Session;

class subjectsController extends Controller {

    public function index() {
        $allsubjects = subjectsModel::all()->where('status', '!=', 0)->sortByDesc("sequences");
        $classes     = classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");
        $search_data = array(
            'search_class'     => "",
            'search_subject'   => "",
            'search_sequences' => "",
            'search_status'    => "",
        );
        return view('subjects')->with(compact(
            'allsubjects',
            'classes'
        ))->with($search_data);
    }

    public function findAction(Request $request) {
        if ($request->has('insert_submit')) {

            $this->validate($request, [
                'class_id'  => 'required',
                'subject'   => 'required',
                'sequences' => 'required'
            ]);

            $sub               = new subjectsModel;
            $sub->subject_name = $request->subject;
            $sub->sequence     = $request->sequences;
            $sub->class_id     = $request->class_id;
            $sub->status       = 1;
            $sub->c_on         = DB::raw('NOW()');
            $sub->c_by         = Session::get('userid');
            $sub->m_on         = DB::raw('NOW()');
            $sub->m_by         = Session::get('userid');

            if ($sub->save()) {
                Session::flash('message', 'Section '.$sub->subject_name.' successfully added');
            } else {
                Session::flash('error_message', 'Something went wrong! Try again!');
            }
            return redirect('/subjects');

        } else if ($request->has('search_submit')) {

            $s_class     = $request->search_class;
            $s_subject   = $request->search_subject;
            $s_sequences = $request->search_sequences;
            $s_status    = $request->search_status;

            $search_data = array(
                'search_class'     => $s_class,
                'search_subject'   => $s_subject,
                'search_sequences' => $s_sequences,
                'search_status'    => $s_status,
            );

            $query = subjectsModel::select('*');

            if ($s_class != "") {$query     = $query->where('class_id', 'like',"%".$s_class."%");}
            if ($s_subject != "") {$query   = $query->where('subject_name', 'like',"%".$s_subject."%");}
            if ($s_sequences != "") {$query = $query->where('sequence', 'like',"%".$s_sequences."%");}
            if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

            $allsubjects = $query->get();

            $classes = classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");

            return view('subjects')->with(compact(
                'allsubjects',
                'classes'
            ))->with($search_data);
        }
    }

    public function update(Request $request) {

        $this->validate($request, [
            'edit_id'        => 'required',
            'edit_classes'   => 'required',
            'edit_sequences' => 'required',
            'edit_subject'   => 'required'
        ]);
        $sub               = subjectsModel::find($request->edit_id);
        $sub->subject_name = $request->edit_subject;
        $sub->class_id     = $request->edit_classes;
        $sub->sequence     = $request->edit_sequences;
        $sub->m_on         = DB::raw('NOW()');
        $sub->m_by         = Session::get('userid');

        if ($sub->save()) {
            Session::flash('message', 'Section '.$sub->subject_name.' successfully Updated');
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }

        return redirect('/subjects');
    }
    public function statusupdate($id, $status) {
        $sub         = subjectsModel::find($id);
        $sub->m_on   = DB::raw('NOW()');
        $sub->m_by   = Session::get('userid');
        $sub->status = $status;

        if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

        if ($sub->save()) {
            Session::flash('message', 'Section '.$sub->class_name.' suscessfully '.$status_t);
        } else {
            Session::flash('error_message', 'Something went wrong! Try again!');
        }
        return redirect('/subjects');
    }

    public function search(Request $request) {

    }

}
