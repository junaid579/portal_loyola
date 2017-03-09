<?php

namespace App\Http\Controllers;

use App\Http\Models\classesModel;
use App\Http\Models\sectionsModel;
use App\Http\Models\occupationModel;
use App\Http\Models\casteModel;
use App\Http\Models\religionModel;
use App\Http\Models\mothertongueModel;
use App\Http\Models\nationalityModel;
use App\Http\Models\admissionModel;

use DB;
use Illuminate\Http\Request;
use Session;
// use App\Http\Controllers\Carbon\Carbon;

class admissionController extends Controller {

	public function index() {
		$alladmissions	 	 = admissionModel::all()->where('status', '!=', 0);
		$classes     	 	 = classesModel::all()->where('status', '=', 1);
		$sections 			 = sectionsModel::all()->where('status', '!=', 0);
		$occupations   		 = occupationModel::all()->where('status', '=', 1);
		$castes      		 = casteModel::all()->where('status', '=', 1);
		$religions    		 = religionModel::all()->where('status', '=', 1);
		$mothertongues       = mothertongueModel::all()->where('status', '=', 1);
		$nationalities       = nationalityModel::all()->where('status', '=', 1);

		//using joins for $sections
		 // $sections = sectionsModel::select('*' )
   //          ->join('classes', 'classes.id', '=', 'sections.class_id')
   //          ->get();
		

		$search_data = array(
			'search_first_name'    	    => "",
			'search_last_name'    	    => "",
			'search_gender'    	    	=> "",
			'search_caste'    	    => "",
			'search_religion'    	    => "",
			'search_mother_tongue'    	    => "",
			'search_nationality'    	    => "",
			'search_date_of_birth'    	    => "",
			'search_birth_place'    	    => "",
			'search_aadhar_no'    	    => "",

			'search_father_income'    	    => "",
			'search_father_name'    	    => "",
			'search_mother_name'    	    => "",
			'search_occupation_id'    	    => "",
			'search_guardian_name'    	    => "",

			'search_mobile_1'    	    => "",
			'search_mobile_2'   		=> "",
			'search_email_1'   		=> "",
			'search_email_2'     => "",
			'search_present_address'  	    => "",
			'search_permanent_address'  	    => "",

			'search_class'    	    => "",
			'search_section'   		=> "",
			'search_roll_no'   		=> "",
			'search_previous_school'   		=> ""
			
		);
		return view('admission')->with(compact(
				'alladmissions',
				'classes',
				'sections',
				'occupations',
				'castes',
				'religions',
				'mothertongues',
				'nationalities'
			))->with($search_data);
	}

	public function findAction(Request $request) {
		if ($request->has('insert_submit')) {

			

			$app                  = new admissionModel;
			$app->first_name              = $request->first_name;
			$app->last_name              = $request->last_name;
			$app->gender                  = $request->genderi;
			$app->caste              = $request->caste;
			$app->religion              = $request->religion ;
			$app->mother_tongue         = $request->mother_tongue;
			$app->nationality         = $request->nationality;
			

			
			$app->date_of_birth  = $request->date_of_birth;

			//$app->date_of_birth          = $request->date_of_birth;


			$app->aadhar_no              = $request->aadhar_no;

			$app->father_income            = $request->father_income;
			$app->father_name              = $request->father_name;
			$app->mother_name              = $request->mother_name;
			$app->occupation          = $request->occupation;
			$app->guardian_name          = $request->guardian_name;

			$app->mobile_1                = $request->mobile_1;
			$app->mobile_2                = $request->mobile_2;
			$app->email_1                = $request->email_1;
			$app->email_2                = $request->email_2;
			$app->present_address          = $request->present_address;
			$app->permanent_address      = $request->permanent_address;

			$app->class_name              = $request->class_name;
			$app->section_name              = $request->section_name;
			$app->previous_school          = $request->previous_school;
			$app->roll_no                = $request->roll_no;

			$app->status       = 1;
			$app->c_on         = DB::raw('NOW()');
			$app->c_by         = Session::get('userid');
			$app->m_on         = DB::raw('NOW()');
			$app->m_by         = Session::get('userid');

			if ($app->save()) {
				Session::flash('message', 'Student  '.$app->first_name .' successfully added');
			} else {
				Session::flash('error_message', 'Something went wrong! Try again!');
			}
			return redirect('/admission');

		} else if ($request->has('search_submit')) {

			$s_first_name              = $request->search_first_name;
			$s_last_name              = $request->search_last_name;
			$s_gender                  = $request->search_gender;
			$s_date_of_birth          = $request->search_date_of_birth;
			$s_birth_place              = $request->search_birth_place;
			$s_caste                    = $request->search_caste;    
			$s_religion                    = $request->search_religion;
			$s_mother_tongue                = $request->search_mother_tongue;    
			$s_nationality                = $request->search_nationality;
			$s_aadhar_no              = $request->search_aadhar_no;
			$s_father_income            = $request->search_father_income;
			$s_father_name              = $request->search_father_name;
			$s_occupation                = $request->search_occupation;
			$s_mother_name              = $request->search_mother_name;
			$s_guardian_name          = $request->search_guardian_name;
			$s_mobile_1                = $request->search_mobile_1;
			$s_mobile_2                = $request->search_mobile_2;
			$s_email_1                = $request->search_email_1;
			$s_email_2                = $request->search_email_2;
			$s_present_address          = $request->search_present_address;
			$s_permanent_address      = $request->search_permanent_address;
			$s_class                    = $request->search_class;    
			$s_section                    = $request->search_section; 
			$s_previous_school          = $request->search_previous_school;
			$s_roll_no                = $request->search_roll_no;

			

			$search_data = array(
				'search_first_name'    => $s_first_name	   ,
				'search_last_name'    	=> $s_last_name    	,
				'search_gender'    	 => $s_gender,
				'search_caste'    	=> $s_caste	,
				'search_religion'    	=> $s_religion  	,
				'search_mother_tongue'    => $s_mother_tongue  	,
				'search_nationality'    => $s_nationality  	,
				'search_date_of_birth'   => $s_date_of_birth 	,
				'search_birth_place'    => $s_birth_place,
				'search_aadhar_no'    	=> $s_aadhar_no	,
				'search_father_income'   => $s_father_income	,
				'search_father_name'    => $s_father_name 	,
				'search_mother_name'    => $s_mother_name  	,
				'search_occupation_id'   => $s_occupation_id  	,
				'search_guardian_name'   => $s_guardian_name,
				'search_mobile_1'    	=> $s_mobile_1,
				'search_mobile_2' => $s_mobile_2,
				'search_email_1' => $s_email_1,
				'search_email_2' => $s_email_2,
				'search_present_address' => $s_present_address 	,
				'search_permanent_address' => $s_permanent_address,
				'search_class'    	=> $s_class,
				'search_section' => $s_section ,
				'search_roll_no' => $s_roll_no,
				'search_previous_school' => $s_previous_school,
			);

			$query = testmasterModel::select('*');  

		if ($s_first_name!= "") {$query=$query->where('first_name','like',"%".$s_first_name."%");}
		if ($s_last_name != "") {$query=$query->where('last_name', 'like',"%".$s_last_name ."%");}
		if ($s_gender !="") {$query=$query->where('gender','like',"%".$s_gender ."%");}
		if ($s_date_of_birth!="") {$query=$query->where('caste','like',"%".$s_date_of_birth."%");}
		if ($s_birth_place  !="") {$query=$query->where('religion',  'like',"%".$s_birth_place  ."%");}
		if ($s_caste  !="") {$query=$query->where('mother_tongue','like',"%".$s_caste  ."%");}
		if ($s_religion  != "") {$query=$query->where('nationality', 'like',"%".$s_religion  ."%");}
		if ($s_mother_tongue !="") {$query=$query->where('date_of_birth','like',"%".$s_mother_tongue ."%");}
		if ($s_nationality  !="") {$query=$query->where('birth_place', 'like',"%".$s_nationality  ."%");}
		if ($s_aadhar_no != "") {$query=$query->where('aadhar_no', 'like',"%".$s_aadhar_no ."%");}
		if ($s_father_income!="") {$query=$query->where('father_income','like',"%".$s_father_income."%");}
		if ($s_father_name  !="") {$query=$query->where('father_name', 'like',"%".$s_father_name  ."%");}
		if ($s_occupation!= "") {$query=$query->where('mother_name', 'like',"%".$s_occupation."%");}
		if ($s_mother_name  !="") {$query=$query->where('occupation_id','like',"%".$s_mother_name  ."%");}
		if ($s_guardian_name!="") {$query=$query->where('guardian_name','like',"%".$s_guardian_name."%");}
		if ($s_mobile_1  != "") {$query=$query->where('mobile_1', 'like',"%".$s_mobile_1  ."%");}
		if ($s_mobile_2  != "") {$query=$query->where('mobile_2' ,'like',"%".$s_mobile_2  ."%");}
		if ($s_email_1!="") {$query=$query->where('email_1','like',"%".$s_email_1."%");}
		if ($s_email_2!="") {$query=$query->where('email_2','like',"%".$s_email_2."%");}
		if ($s_present_address !=""){$query = $query->where('present_address','like',"%".$s_present_address ."%");}
		if ($s_permanent_address  != "") {$query = $query->where('permanent_address','like',"%".$s_permanent_addres."%");}
		if ($s_class  !="") {$query=$query->where('class', 'like',"%".$s_class  ."%");}
		if ($s_section!="") {$query=$query->where('section','like',"%".$s_section."%");}
		if ($s_previous_school !="") {$query=$query->where('roll_no','like',"%".$s_previous_school ."%");}
		if ($s_roll_no!="") {$query=$query->where('previous_school' ,'like',"%".$s_roll_no."%");}

			$alladmissions = $query->get();

			$classes     	 	 = classesModel::all()->where('status', '=', 1);
			$sections 			 = sectionsModel::all()->where('status', '!=', 0);
			$occupations   		 = occupationModel::all()->where('status', '=', 1);
			$castes      		 = casteModel::all()->where('status', '=', 1);
			$religions    		 = religionModel::all()->where('status', '=', 1);
			$mothertongues       = mother_tongueModel::all()->where('status', '=', 1);
			$nationalities       = nationalityModel::all()->where('status', '=', 1);


			return view('admission')->with(compact(
				'alladmissions',
				'classes',
				'sections',
				'occupations',
				'castes',
				'religions',
				'mothertongues',
				'nationalities'
				))->with($search_data);
		}
	}

	public function update(Request $request) {

		$this->validate($request, [

					'edit_first_name '  => 'required',
					'edit_last_name '  => 'required',
					'edit_gender '  => 'required',
					'edit_caste_id '  => 'required',
					'edit_religion_id '  => 'required',
					'edit_mother_tongue_id '  => 'required',
					'edit_nationality_id '  => 'required',
					'edit_date_of_birth '  => 'required',
					'edit_birth_place '  => 'required',
					'edit_aadhar_no '  => 'required',
					'edit_father_income	'  => 'required',
					'edit_father_name '  => 'required',
					'edit_mother_name '  => 'required',
					'edit_occupation_id '  => 'required',
					'edit_guardian_name '  => 'required',
					'edit_mobile_1	'  => 'required',
					'edit_mobile_2	'  => 'required',
					'edit_email_1'  => 'required',
					'edit_email_2'  => 'required',
					'edit_present_address '  => 'required',
					'edit_permanent_address '  => 'required',
					'edit_class_id'  => 'required',
					'edit_section_id '  => 'required',
					'edit_previous_school '  => 'required'
			]);
		$app               = admissionModel::find($request->edit_id);
		$app->first_name       = $request->edit_first_name   ;
		$app->last_name        = $request->edit_last_name   ;
		$app->gender           = $request->edit_gender   ;
		$app->caste         = $request->edit_caste_id   ;
		$app->religion_id      = $request->edit_religion_id   ;
		$app->mother_tongue_id  = $request->edit_mother_tongue_id  ;
		$app->nationality_id   = $request->edit_nationality_id  ; 
		$app->date_of_birth    = $request->edit_date_of_birth   ;
		$app->birth_place      = $request->edit_birth_place   ;
		$app->aadhar_no        = $request->edit_aadhar_no   ;
		$app->father_income    = $request->edit_father_income	;
		$app->father_name      = $request->edit_father_name   ;
		$app->mother_name      = $request->edit_mother_name   ;
		$app->occupation_id    = $request->edit_occupation_id   ;
		$app->guardian_name    = $request->edit_guardian_name   ;
		$app->mobile_1         = $request->edit_mobile_1	;
		$app->mobile_2         = $request->edit_mobile_2	;
		$app->email_1          = $request->edit_email_1	;
		$app->email_2          = $request->edit_email_2	;
		$app->present_address  = $request->edit_present_address   ;
		$app->permanent_address= $request->edit_permanent_address   ;
		$app->class_id         = $request->edit_class_id  ;
		$app->section_id       = $request->edit_section_id   ;
		$app->previous_school  = $request->edit_previous_school   ;
		$app->roll_no          = $request->edit_roll_no	   ;
		$app->m_on         = DB::raw('NOW()');
		$app->m_by         = Session::get('userid');

		if ($app->save()) {
			Session::flash('message', 'Student  '.$app->first_name .' successfully Updated');
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}

		return redirect('/admission');
	}
	public function statusupdate($id, $status) {
		$app         = admissionModel::find($id);
		$app->m_on   = DB::raw('NOW()');
		$app->m_by   = Session::get('userid');
		$app->status = $status;

		if ($status == 1) {$status_t = "Activated";} else if ($status == 2) {$status_t = "Suspended";} else if ($status == 0) {$status_t = "Deleted";}

		if ($app->save()) {
			Session::flash('message', 'Student  '.$app->first_name .' suscessfully '.$status_t);
		} else {
			Session::flash('error_message', 'Something went wrong! Try again!');
		}
		return redirect('/admission');
	}

	public function search(Request $request) {

	}

}
