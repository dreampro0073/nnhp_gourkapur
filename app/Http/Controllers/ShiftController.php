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

	public function init(){

		$current_shift = Entry::checkShift();
		$dail_entry = Entry::totalShiftData();
		
		$data['dail_entry'] = $dail_entry;
		
		$data['total_shift_upi'] = $dail_entry['total_shift_upi'];
        $data['total_shift_cash'] = $dail_entry['total_shift_cash'];
        $data['total_collection'] = $dail_entry['total_collection'];

        $data['last_hour_upi_total'] = $dail_entry['last_hour_upi_total'];
        $data['last_hour_cash_total'] = $dail_entry['last_hour_cash_total'];
        $data['last_hour_total'] = $dail_entry['last_hour_total'];
        
        $data['check_shift'] = $current_shift;
        $data['shift_date'] = $dail_entry['shift_date'];

		$data['success'] = true;
		return Response::json($data, 200, []);
	}
	
	public function prevInit(){

		$current_shift = Entry::checkShift(2);
		$shitting_data = Entry::totalPrevShiftData();
		$massage_data = Massage::totalPrevShiftData();
		$locker_data = Locker::totalPrevShiftData();

		$data['shitting_data'] = $shitting_data;
		// dd($data);
		$data['massage_data'] = $massage_data;
		$data['locker_data'] = $locker_data;

		$data['total_shift_upi'] = $shitting_data['total_shift_upi'] + $massage_data['total_shift_upi'] + $locker_data['total_shift_upi'];
        $data['total_shift_cash'] = $shitting_data['total_shift_cash'] + $massage_data['total_shift_cash'] + $locker_data['total_shift_cash'];
        $data['total_collection'] = $shitting_data['total_collection'] + $massage_data['total_collection'] + $locker_data['total_collection'];
        
        $data['check_shift'] = $current_shift;
        $data['shift_date'] = $shitting_data['shift_date'];

        $data['previous_data'] = '';

		$data['success'] = true;
		return Response::json($data, 200, []);
	}

	public function print($type =1){
		$current_shift = Entry::checkShift($type);

		$current_shift = Entry::checkShift(2);



		if($type == 1){


			$shitting_data = Entry::totalShiftData();
			$massage_data = Massage::totalShiftData();
			$locker_data = Locker::totalShiftData();
		}else{
			$shitting_data = Entry::totalPrevShiftData();
			$massage_data = Massage::totalPrevShiftData();
			$locker_data = Locker::totalPrevShiftData();
		}
		// dd($shitting_data);
	
		
		$total_shift_upi = $shitting_data['total_shift_upi'] + $massage_data['total_shift_upi'] + $locker_data['total_shift_upi'];
        $total_shift_cash = $shitting_data['total_shift_cash'] + $massage_data['total_shift_cash'] + $locker_data['total_shift_cash'];
        $total_collection = $shitting_data['total_collection'] + $massage_data['total_collection'] + $locker_data['total_collection'];
        
        return view('admin.print_shift',[
        	'total_shift_upi'=>$total_shift_upi,
        	'total_shift_cash'=>$total_shift_cash,
        	'total_collection'=>$total_collection,
        	'shitting_data'=>$shitting_data,
        	'massage_data'=>$massage_data,
        	'locker_data'=>$locker_data,
        ]);
	}

}
