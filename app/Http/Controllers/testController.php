<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
	public function index(){
        
        return view('/test');
    }
	public function findAction(\Illuminate\Http\Request $request) {
	    if ($request->has('save')) {
	        return $this->dispatch(new \App\Jobs\showOne($request));
	    } else if ($request->has('show')) {
	        return $this->dispatch(new \App\Jobs\showTwo($request));
	    }
	    return 'no action found';
	}
}