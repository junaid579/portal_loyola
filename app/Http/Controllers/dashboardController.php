<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\sectionsModel;
use App\Http\Models\classesModel;
use App\Http\Models\staffModel;
use App\Http\Models\transportPickupModel;



use Session;
use Config;
use DB;

class dashboardController extends Controller
{
   
    public function dashboard(){

        $allsections = sectionsModel::all()->where('status','=',1);
        $allclasses = classesModel::all()->where('status','=',1);
        $allstaff = staffModel::all()->where('status','=',1 );
        $alltransportPickup = transportPickupModel::all()->where('status','=',1);
        // return view('/dashboard' , compact('allclasses')
        //                             , compact('allsections')
        //                             , compact('allstaff')
        //                             , compact('alltransportPickup'));
        
        // Data arrays for models 
        // $data = array('allsections'=>$allsections);
        // $data_class = array('allclasses'=>$allclasses);
        // $data_staff = array ('allstaff' => $allstaff);
        // $data_pickup = array('alltransportPickup' => $alltransportPickup);


        return view('/dashboard') ->with(compact('allclasses', 'allsections', 'allstaff' , 
                                                    'alltransportPickup'));

    } 
  
}

