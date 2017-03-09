<?php

namespace App\Http\Controllers;

use App\Http\Models\classesModel;
use App\Http\Models\sectionsModel;
use App\Http\Models\paymentTypesMasterModel;
use App\Http\Models\staffModel;
use App\Http\Models\admissionmodel;



use DB;
use Illuminate\Http\Request;
use Session;

class dashboardController extends Controller {

	public function dashboard() {
		$sections 		= sectionsModel::all()->where('status', '!=', 0)->sortByDesc("sequences");
		$classes     	= classesModel::all()->where('status', '=', 1)->sortByDesc("sequences");
		$paymentTypes 	= paymentTypesMasterModel::all()->where('status', '!=', 0);
		$staffs 		= staffModel::all()->where('status', '!=', 0);
		$admissions 	= admissionmodel::all()->where('status', '!=', 0);

		
		return view('dashboard')->with(compact(
				'sections',
				'classes',
				'paymentTypes',
				'staffs',
				'admissions'
			));
	}
}
