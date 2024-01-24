<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User, App\Models\Entry;

class AdminController extends Controller {



	public function dashboard(Request $request){

		$avail_pods = Entry::getAvailPodsAr();
		$avail_cabins = Entry::getAvailSinCabinsAr();
		$avail_beds = Entry::getAvailBedsAr();
		    
		return view('admin.dashboard', [
            "sidebar" => "dashboard",
            "subsidebar" => "dashboard",
            "avail_pods" => $avail_pods,
            "avail_cabins" => $avail_cabins,
            "avail_beds" => $avail_beds,
        ]);
	}	

	public function sitting(Request $request){
		    
		return view('admin.entries.index_new', [
            "sidebar" => "sitting",
            "subsidebar" => "sitting",
        ]);
	}
}