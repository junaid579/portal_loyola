<?php

namespace App\Http\Controllers;

use App\Http\Models\classesModel;
use App\Http\Models\sectionsModel;

use DB;
use Illuminate\Http\Request;
use Session;

class sectionsController extends Controller {

	public function index() {
		$allsections = sectionsModel::all()->where('status', '!=', 0)->sortByDesc("sequences");
		$classes     = classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");
		
		$search_data = array(
			'search_class'     => "",
			'search_section'   => "",
			'search_sequences' => "",
			'search_status'    => "",
		);
		return view('sections')->with(compact(
				'allsections',
				'classes'
			))->with($search_data);
		$reflector = new ReflectionClass("sections");
$fn = $reflector->getFileName();
dd($fn);
	}

	public function findAction(Request $request) {
		if ($request->has('insert_submit')) {

			$this->validate($request, [
					'class_id'  => 'required',
					'section'   => 'required',
					'sequences' => 'required'
				]);

			$sec               = new sectionsModel;
			$sec->section_name = $request->section;
			$sec->sequence     = $request->sequences;
			$sec->class_id     = $request->class_id;
			$sec->status       = 1;
			$sec->c_on         = DB::raw('NOW()');
			$sec->c_by         = Session::get('userid');
			$sec->m_on         = DB::raw('NOW()');
			$sec->m_by         = Session::get('userid');

			if ($sec->save()) {
				Session::flash('message', 'Section '.$sec->section_name.' successfully added');
			} else {
				Session::flash('error_message', 'Something went wrong! Try again!');
			}
			return redirect('/sections');

		} else if ($request->has('search_submit')) {

			$s_class     = $request->search_class;
			$s_section   = $request->search_section;
			$s_sequences = $request->search_sequences;
			$s_status    = $request->search_status;

			$search_data = array(
				'search_class'     => $s_class,
				'search_section'   => $s_section,
				'search_sequences' => $s_sequences,
				'search_status'    => $s_status,
			);

			$query = sectionsModel::select('*');   

			if ($s_class != "") {$query     = $query->where('class_id', 'like',"%".$s_class."%");}
			if ($s_section != "") {$query   = $query->where('section_name', 'like',"%".$s_section."%");}
			if ($s_sequences != "") {$query = $query->where('sequence', 'like',"%".$s_sequences."%");}
			if ($s_status != "") {$query    = $query->where('status','like',"%".$s_status."%");}

			$allsections = $query->get();

			$classes = classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");

			return view('sections')->with(compact(
					'allsections',
					'classes'
				))->with($search_data);
		}
	}

	public function update(Request $request) {

		$this->validate($request, [
				'edit_id'        => 'required',
				'edit_classes'   => 'required',
				'edit_sequences' => 'required',
				'edit_section'   => 'required'
			]);
		$sec               = sectionsModel::find($request->edit_id);
		$sec->section_name = $request->edit_section;
		$sec->class_id     = $request->edit_classes;
		$sec->sequence     = $request->edit_sequences;
		$sec->m_on         = DB::raw('NOW()');
		$sec->m_by         = Session::get('userid');

		if ($sec->save()) {
			Session::flash('message', 'Section '.$sec->section_name.' successfully Updated');
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}

		return redirect('/sections');
	}
	public function statusupdate($id, $status) {
		$sec         = sectionsModel::find($id);
		$sec->m_on   = DB::raw('NOW()');
		$sec->m_by   = Session::get('userid');
		$sec->status = $status;

		if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

		if ($sec->save()) {
			Session::flash('message', 'Section '.$sec->class_name.' suscessfully '.$status_t);
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}
		return redirect('/sections');
	}

	public function search(Request $request) {

	}

}
