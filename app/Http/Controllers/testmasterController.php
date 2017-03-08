<?php

namespace App\Http\Controllers;

use App\Http\Models\classesModel;
use App\Http\Models\sectionsModel;
use App\Http\Models\subjectsModel;
use App\Http\Models\testtypeModel;
use App\Http\Models\testmasterModel;

use DB;
use Illuminate\Http\Request;
use Session;

class testmasterController extends Controller {

	public function index() {
		$alltestmaster	 = testmasterModel::all()->where('status', '!=', 0);
		$classes     	 = classesModel::all()->where('status', '=', 1);
		//$sections 		 = sectionsModel::all()->where('status', '!=', 0);
		// using joins for $sections
		 $sections = sectionsModel::select('*' )
            ->join('classes', 'classes.id', '=', 'sections.class_id')
            ->get();
		$subjects    	 = subjectsModel::all()->where('status', '=', 1);
		$testtypes       = testtypeModel::all()->where('status', '=', 1);

		$search_data = array(
			'search_class'     => "",
			'search_section'   => "",
			'search_subject'   => "",
			'search_testtype'   => "",
			'search_test_name'   => "",
			'search_status'    => "",
		);
		return view('testmaster')->with(compact(
				'alltestmaster',
				'classes',
				'sections',
				'subjects',
				'testtypes'
			))->with($search_data);
	}

	public function findAction(Request $request) {
		if ($request->has('insert_submit')) {

			$this->validate($request, [
					'class_id'  => 'required',
					'section_id'   => 'required',
					'subject_id'   => 'required',
					'testtype_id'   => 'required',
					'test_name'   => 'required'
				]);

			$ttm                  = new testmasterModel;
			$ttm->class_id 		  = $request->class_id;
			$ttm->section_id      = $request->section_id;
			$ttm->subject_id      = $request->subject_id;
			$ttm->testtype_id     = $request->testtype_id;
			$ttm->test_name       = $request->test_name;

			$ttm->status       = 1;
			$ttm->c_on         = DB::raw('NOW()');
			$ttm->c_by         = Session::get('userid');
			$ttm->m_on         = DB::raw('NOW()');
			$ttm->m_by         = Session::get('userid');

			if ($ttm->save()) {
				Session::flash('message', 'Test '.$ttm->test_name .' successfully added');
			} else {
				Session::flash('error_message', 'Something went wrong! Try again!');
			}
			return redirect('/testmaster');

		} else if ($request->has('search_submit')) {

			$s_class       	  = $request->search_class;
			$s_section 	 	  = $request->search_section;
			$s_subject 		  = $request->search_subject;
			$s_testtype  	  = $request->search_testtype;
			$s_test_name 	  = $request->search_test_name;
			$s_status   	  = $request->search_status;

			$search_data = array(
				'search_class'     => $s_class,
				'search_section'   => $s_section,
				'search_subject' => $s_subject,
				'search_testtype' => $s_testtype,
				'search_test_name' => $s_test_name,
				'search_status'    => $s_status,
			);

			$query = testmasterModel::select('*');  

			if ($s_class != "") {$query     = $query->where('class_id', 'like',"%".$s_class."%");}
			if ($s_section != "") {$query   = $query->where('section_name', 'like',"%".$s_section."%");}
			if ($s_subject != "") {$query   = $query->where('subject_name', 'like',"%".$s_subject."%");}
			if ($s_testtype != "") {$query   = $query->where('test_type', 'like',"%".$s_testtype."%");}
			if ($s_test_name != "") {$query = $query->where('test_name',  'like',"%".$s_test_name."%");}
			if ($s_status != "") {$query    = $query->where('status', 'like',"%".$s_status."%");}

			$alltestmaster = $query->get();

			$sections 		 = sectionsModel::all()->where('status', '!=', 0)->sortByDesc("sequences");
			$classes     	 = classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");
			$subjects    	 = subjectsModel::all()->where('status', '=', 1)->sortByDesc("sequences");
			$testtypes       = testtypeModel::all()->where('status', '=', 1)->sortByDesc("sequences");


			return view('testmaster')->with(compact(
					'alltestmaster',
					'classes',
					'sections',
					'subjects',
					'testtypes'
				))->with($search_data);
		}
	}

	public function update(Request $request) {

		$this->validate($request, [
				'edit_id'        => 'required',
				'edit_classes'   => 'required',
				'edit_subjects' => 'required',
				'edit_testtypes' => 'required',
				'edit_test_name' => 'required',
				'edit_sections'   => 'required'
			]);
		$ttm               = testmasterModel::find($request->edit_id);
		$ttm->test_name = $request->edit_test_name;
		$ttm->class_id     = $request->edit_classes;
		$ttm->section_id     = $request->edit_sections;
		$ttm->subject_id     = $request->edit_subjects;
		$ttm->testtype_id     = $request->edit_testtypes;
		$ttm->m_on         = DB::raw('NOW()');
		$ttm->m_by         = Session::get('userid');

		if ($ttm->save()) {
			Session::flash('message', 'Test '.$ttm->test_name .' successfully Updated');
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}

		return redirect('/testmaster');
	}
	public function statusupdate($id, $status) {
		$ttm         = testmasterModel::find($id);
		$ttm->m_on   = DB::raw('NOW()');
		$ttm->m_by   = Session::get('userid');
		$ttm->status = $status;

		if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

		if ($ttm->save()) {
			Session::flash('message', 'Test '.$ttm->test_name .' suscessfully '.$status_t);
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}
		return redirect('/testmaster');
	}

	public function search(Request $request) {

	}

}
