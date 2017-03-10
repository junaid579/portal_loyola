<?php 

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class transportTermBreakUpModel extends MyBaseModel {

	protected $connection = 'key';
	protected $table = 'transport_term_break_up';
	public $timestamps  = false;

	public function datainsert($req,$pid){
		$no_of_terms = $req->input('no_of_terms');
		for($i=1;$i<=$no_of_terms;$i++){
			$data['pickup_id']			= $pid;
			$data['term']  				= $i;
			$data['twoway_term_amount'] 	= $req->input("termamount_twoway".$i);
			$data['oneway_termamount']  	= $req->input("termamount_oneway".$i);
			$data['term_month'] 			= $req->input("month_term".$i);
			$data['term_year']			= $req->input("year".$i);
			$data['status'] = 1;
			$data['c_on']   = DB::raw('NOW()');
			$data['c_by']   = Session::get('userid');
			$data['m_on']   = DB::raw('NOW()');
			$data['m_by']   = Session::get('userid');
			$this->insert($data);	
		}
		return 1;
    }
    public function dataUpdate($req,$pid){
    	$no_of_terms = $req->input('e_no_of_terms');
    	$this->where('pickup_id', '=', $pid)->update(['status' => 0]);
    	for($i=1;$i<=$no_of_terms;$i++){
			if($req->input('e_terms_ids'.$i)!=0){
				$upd = $this->find($req->input('e_terms_ids'.$i));
				$upd->term  = $i;
				$upd->twoway_term_amount = $req->input("e_termamount_twoway".$i);
				$upd->oneway_termamount  = $req->input("e_termamount_oneway".$i);
				$upd->term_month 		 = $req->input("e_month_term".$i);
				$upd->term_year			 = $req->input("e_year".$i);
				$upd->status = 1;
				$upd->m_on   = DB::raw('NOW()');
				$upd->m_by   = Session::get('userid');
				$upd->save();	
			}else{
				$data['pickup_id']			= $pid;
				$data['term']  				= $i;
				$data['twoway_term_amount'] = $req->input("e_termamount_twoway".$i);
				$data['oneway_termamount']  = $req->input("e_termamount_oneway".$i);
				$data['term_month'] 		= $req->input("e_month_term".$i);
				$data['term_year']			= $req->input("e_year".$i);
				$data['status'] = 1;
				$data['c_on']   = DB::raw('NOW()');
				$data['c_by']   = Session::get('userid');
				$data['m_on']   = DB::raw('NOW()');
				$data['m_by']   = Session::get('userid');
				$this->insert($data);
			} 
		}
		return 1;
	}

}