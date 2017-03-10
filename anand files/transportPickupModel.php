<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class transportPickupModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'transport_pickup';
	public $timestamps  = false;

	public function getTransportPickupTerms(){
    	$twowayconcat 	 = DB::raw('GROUP_CONCAT(ttbu.twoway_term_amount) AS twowayconcat');
		$onewayconcat 	 = DB::raw('GROUP_CONCAT(ttbu.oneway_termamount) AS onewayconcat');
		$termmonthconcat = DB::raw('GROUP_CONCAT(ttbu.term_month) AS termmonthconcat');
		$termyearconcat  = DB::raw('GROUP_CONCAT(ttbu.term_year) AS termyearconcat');
		$termsids  = DB::raw('GROUP_CONCAT(ttbu.id) AS termsids');
		return $this
			->from( 'transport_pickup as tpu')
            ->join('transport_term_break_up as ttbu', 'tpu.id', '=', 'ttbu.pickup_id')
            ->select('tpu.id as tpuid', 'tpu.pickup_point_name', 'tpu.two_way_amount', 'tpu.one_way_amount', 
            	'tpu.no_of_terms', 'tpu.status',$twowayconcat,$onewayconcat,$termmonthconcat,$termyearconcat,$termsids)
            ->groupby('tpuid')
            ->where([['tpu.status','!=', '0'],['ttbu.status','!=','0']])
            ->get(); 
    }

    public function getTransportPickupTermsSearch($search){
    	$twowayconcat 	 = DB::raw('GROUP_CONCAT(ttbu.twoway_term_amount) AS twowayconcat');
		$onewayconcat 	 = DB::raw('GROUP_CONCAT(ttbu.oneway_termamount) AS onewayconcat');
		$termmonthconcat = DB::raw('GROUP_CONCAT(ttbu.term_month) AS termmonthconcat');
		$termyearconcat  = DB::raw('GROUP_CONCAT(ttbu.term_year) AS termyearconcat');
		$termsids  = DB::raw('GROUP_CONCAT(ttbu.id) AS termsids');
		
		
		
		$data =	$this
			->from( 'transport_pickup as tpu')
            ->join('transport_term_break_up as ttbu', 'tpu.id', '=', 'ttbu.pickup_id')
            ->select('tpu.id as tpuid', 'tpu.pickup_point_name', 'tpu.two_way_amount', 'tpu.one_way_amount', 
            	'tpu.no_of_terms', 'tpu.status',$twowayconcat,$onewayconcat,$termmonthconcat,$termyearconcat,$termsids)
            ->groupby('tpuid')
            ->where('ttbu.status','!=', '0');
		if($search['search_pickuppoint']!=""){
			$data->where("tpu.pickup_point_name","like","%".$search['search_pickuppoint']."%");
		}
		if($search['search_twowayfee']!=""){
			$data->where("tpu.two_way_amount","=",$search['search_twowayfee']);
		}
		if($search['search_onewayfee']!=""){
			$data->where("tpu.one_way_amount","=",$search['search_onewayfee']);
		}
		if($search['search_noofterms']!=""){
			$data->where("tpu.no_of_terms","=",$search['search_noofterms']);
		}
		if($search['search_status']!=""){
			$data->where("tpu.status","=",$search['search_status']);
		}	

		return $data->get(); 
       
    }

    public function datainsert($req){
    	$this->pickup_point_name = $req->input('pickup_point_name');
		$this->two_way_amount    = $req->input('twoway_amount');
		$this->one_way_amount    = $req->input('oneway_amount');
		$this->no_of_terms 		= $req->input('no_of_terms');
		$this->status = 1;
		$this->c_on   = DB::raw('NOW()');
		$this->c_by   = Session::get('userid');
		$this->m_on   = DB::raw('NOW()');
		$this->m_by   = Session::get('userid');
		$this->save();
		return $this->id;
    }

    public function dataUpdate($req){
    	$upd = $this->find($req->input('edit_id'));
    	$temp_no_of_terms = $upd->no_of_terms;
    	$upd->pickup_point_name = $req->input('e_pickup_point_name');
		$upd->two_way_amount    = $req->input('e_twoway_amount');
		$upd->one_way_amount    = $req->input('e_oneway_amount');
		$upd->no_of_terms 		= $req->input('e_no_of_terms');
		$upd->m_on   = DB::raw('NOW()');
		$upd->m_by   = Session::get('userid');
		$upd->save();
		return $upd->id;
	}

	public function pickupStatusUpdate($id,$status){
		$upd = $this->find($id);
		$upd->m_on   = DB::raw('NOW()');
		$upd->m_by   = Session::get('userid');
		$upd->status = $status;
		$upd->save();
		return $upd->pickup_point_name;
	}

}