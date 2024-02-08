<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User;
use App\Models\Entry;



class ShiftController extends Controller {
	
	public function index(){
		return view('admin.shift.index', [
            "sidebar" => "shift",
            "subsidebar" => "shift",
        ]);
		
	}
	public function prevIndex(){

		return view('admin.shift.prev_shift', [
            "sidebar" => "pshift",
            "subsidebar" => "pshift",
        ]);
		
	}

	public function init(Request $request){

		$users = DB::table('users')->select('id','name')->get();

		$input_date = $request->input_date;
		$user_id = $request->has('user_id')?$request->user_id:0;

		$current_shift = Entry::checkShift();
		$pod_data = Entry::totalShiftData(1,$input_date,$user_id);
		$cabin_data = Entry::totalShiftData(2,$input_date,$user_id);
		$bed_data = Entry::totalShiftData(3,$input_date,$user_id);
		
		$data['pod_data'] = $pod_data;
		$data['cabin_data'] = $cabin_data;
		$data['bed_data'] = $bed_data;
		
		$data['total_shift_upi'] = $pod_data['total_shift_upi'] + $cabin_data['total_shift_upi'] + $bed_data['total_shift_upi'];
        $data['total_shift_cash'] = $pod_data['total_shift_cash'] + $cabin_data['total_shift_cash'] + $cabin_data['total_shift_cash'];
        $data['total_collection'] = $pod_data['total_collection'] + $cabin_data['total_collection'] + $bed_data['total_collection'];

        $data['last_hour_upi_total'] = $pod_data['last_hour_upi_total'] + $cabin_data['last_hour_upi_total'] + $bed_data['last_hour_upi_total'];
        $data['last_hour_cash_total'] = $pod_data['last_hour_cash_total'] + $cabin_data['last_hour_cash_total'] + $bed_data['last_hour_cash_total'];
        $data['last_hour_total'] = $pod_data['last_hour_total'] + $cabin_data['last_hour_total'] + $bed_data['last_hour_total'];
        
        $data['check_shift'] = $current_shift;
        $data['shift_date'] = $pod_data['shift_date'];

		$data['success'] = true;
		$data['users'] = $users;
		return Response::json($data, 200, []);
	}
	

	public function print($type =1){
		$current_shift = Entry::checkShift($type);

		if($type == 1){
			$pod_data = Entry::totalShiftData(1);
			$cabin_data = Entry::totalShiftData(2);
			$bed_data = Entry::totalShiftData(3);
		}else{
			$pod_data = Entry::totalShiftData(1);
			$cabin_data = Entry::totalShiftData(2);
			$bed_data = Entry::totalShiftData(3);
		}
		
		$total_shift_upi = $pod_data['total_shift_upi'] + $cabin_data['total_shift_upi'] + $bed_data['total_shift_upi'];
        $total_shift_cash = $pod_data['total_shift_cash'] + $cabin_data['total_shift_cash'] + $bed_data['total_shift_cash'];
        $total_collection = $pod_data['total_collection'] + $cabin_data['total_collection'] + $bed_data['total_collection'];
        
        return view('admin.print_shift',[
        	'total_shift_upi'=>$total_shift_upi,
        	'total_shift_cash'=>$total_shift_cash,
        	'total_collection'=>$total_collection,
        	'pod_data'=>$pod_data,
        	'cabin_data'=>$cabin_data,
        	'bed_data'=>$bed_data,
        ]);
	}

}
