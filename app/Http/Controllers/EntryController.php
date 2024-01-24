<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\Massage, App\Models\User;
use App\Models\Entry;

class EntryController extends Controller {	
	public function index($type){
		$sidebar = 'pods';
        $subsidebar = 'pods';

		if($type == 2){
			$sidebar = 'scabins';
           	$subsidebar = 'scabins';
		}

		if($type == 3){
			$sidebar = 'beds';
           	$subsidebar = 'beds';
		}

		return view('admin.entries.index', [
            "sidebar" =>$sidebar,
            "subsidebar" => $subsidebar,
            "type" => $type,
        ]);
	}
	
	public function initEntry(Request $request,$type){
		

		$entries = DB::table('entries')->select('entries.*','users.name as username')->leftJoin('users','users.id','=','entries.delete_by');
		if($request->unique_id){
			$entries = $entries->where('entries.unique_id', 'LIKE', '%'.$request->unique_id.'%');
		}		

		if($request->name){
			$entries = $entries->where('entries.name', 'LIKE', '%'.$request->name.'%');
		}		
		if($request->mobile_no){
			$entries = $entries->where('entries.mobile_no', 'LIKE', '%'.$request->mobile_no.'%');
		}		
		if($request->pnr_uid){
			$entries = $entries->where('entries.pnr_uid', 'LIKE', '%'.$request->pnr_uid.'%');
		}		
		
		if(Auth::user()->priv != 1){
			$entries = $entries->where('deleted',0);
		}
		// $entries = $entries->where('type',$type)->where('checkout_status', 0);
		$entries = $entries->where('checkout_status',0)->where('type',$type);
		$entries = $entries->orderBy('id', "DESC")->get();


		$pay_types = Entry::payTypes();
		$hours = Entry::hours();
		$show_pay_types = Entry::showPayTypes();
		$avail_pods = Entry::getAvailPods();
		$avail_cabins = Entry::getAvailSinCabins();
		$avail_beds = Entry::getAvailBeds();

		$data['success'] = true;
		$data['entries'] = $entries;
		$data['pay_types'] = $pay_types;
		$data['hours'] = $hours;
		$data['avail_pods'] = $avail_pods;
		$data['avail_cabins'] = $avail_cabins;
		$data['avail_beds'] = $avail_beds;

		return Response::json($data, 200, []);
	}
	public function editEntry(Request $request){
		$l_entry = Entry::where('id', $request->entry_id)->first();

		$sl_pods = [];

		if($l_entry){
			$l_entry->mobile_no = $l_entry->mobile_no*1;
			$l_entry->train_no = $l_entry->train_no*1;
			$l_entry->pnr_uid = $l_entry->pnr_uid;
			$l_entry->paid_amount = $l_entry->paid_amount*1;
			$l_entry->check_in = date("h:i A",strtotime($l_entry->check_in));
			$l_entry->check_out =date("h:i A",strtotime($l_entry->check_out));
			$sl_pods = explode(',', $l_entry->e_ids);
		}

		$data['success'] = true;
		$data['l_entry'] = $l_entry;
		$data['sl_pods'] = $sl_pods;
		return Response::json($data, 200, []);
	}
	public function calCheck(Request $request){
		
		$check_in = $request->check_in;
		$no_of_day = $request->no_of_day;

		$hours = 24*$no_of_day;
		$ss_time = strtotime(date("h:i A",strtotime($check_in)));
		$new_time = date("h:i A", strtotime('+'.$hours.' hours', $ss_time));

		$data['success'] = true;
		$data['check_out'] = $new_time;
		return Response::json($data, 200, []);
	}

	public function store(Request $request,$type){

		$check_shift = Entry::checkShift();

		$cre = [
			'name'=>$request->name,
		];

		$rules = [
			'name'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){
			$total_amount = $request->total_amount;
			if($request->id){
				$group_id = $request->id;
				$entry = Entry::find($request->id);
				$message = "Updated Successfully!";

				if(isset($entry)){
					if($check_shift != $entry->shift){
						$total_amount = $total_amount - $entry->paid_amount;
						$entry = new Entry;
						$message = "Stored Successfully!";
						$entry->unique_id = strtotime('now');
					}
				}

			} else {
				$entry = new Entry;
				$message = "Stored Successfully!";
				$entry->unique_id = strtotime('now');
				
			}

			$entry->name = $request->name;
			$entry->pnr_uid = $request->pnr_uid;
			$entry->mobile_no = $request->mobile_no;
			
			
			$entry->hours_occ = $request->hours_occ ? $request->hours_occ : 0;

			if($request->id){
				$entry->check_in = date("H:i:s",strtotime($request->check_in));
			}else{
				$entry->check_in = date("H:i:s");
			}

			
			$entry->paid_amount = $total_amount;
			$entry->pay_type = $request->pay_type;
			$entry->remarks = $request->remarks;
			$entry->shift = $check_shift;
			$entry->type = $type;
			$entry->save();
			$no_of_min = $request->hours_occ*60;

			$entry->check_out = date("H:i:s",strtotime("+".$no_of_min." minutes",strtotime($entry->check_in)));

			$check_in_time = strtotime($entry->check_in);
        	$date = Entry::getPDate();
	        $entry->date = $date;
			$entry->added_by = Auth::id();
			$entry->user_session_id = Auth::user()->session_id;


			if($type ==1){
				$sl_pods = $request->sl_pods;
				$entry->e_ids = implode(',', $sl_pods);
				DB::table("pods")->whereIn('id',$sl_pods)->update(['status'=>1]);
			}
			if($type == 2){
				$sl_cabins = $request->sl_cabins;
				$entry->e_ids = implode(',', $sl_cabins);
				DB::table("single_cabins")->whereIn('id',$sl_cabins)->update(['status'=>1]);
			}

			if($type == 3){
				$sl_beds = $request->sl_beds;
				$entry->e_ids = implode(',', $sl_beds);
				DB::table("double_beds")->whereIn('id',$sl_beds)->update(['status'=>1]);
			}

			
			$entry->save();


			$data['id'] = $entry->id;
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}

	public function printPost($id = 0){

        $print_data = DB::table('entries')->where('id', $id)->first();
        return view('admin.print_page_entery', compact('print_data'));
	}


    public function checkoutInit(Request $request){

    	$now_time = strtotime(date("Y-m-d H:i:s",strtotime("+10 minutes")));

    	$l_entry = Entry::where('id', $request->entry_id)->first();

    	$checkout_time = strtotime($l_entry->check_out);

    	if($checkout_time > $now_time){
    		$data['timeOut'] = false;
    		$entry = Entry::find($request->entry_id);
    		$entry->status = 1; 
    		$entry->checkout_status = 1; 
    		$entry->save();
    		$data['success'] = true;

			$e_ids = explode(',', $l_entry->e_ids);

			Entry::updateAvailStatus($l_entry->type,$e_ids);

			// dd($e_ids);
    
    	} else {
    		$hour = round(($now_time - $checkout_time)/(60 * 60));
    		$e_ids = explode(',', $l_entry->e_ids);

			$l_entry->mobile_no = $l_entry->mobile_no*1;
			$l_entry->pnr_uid = $l_entry->pnr_uid*1;
			$l_entry->paid_amount = $l_entry->paid_amount*1;

			$l_entry->check_in = date("H:i A",strtotime($l_entry->check_in));
			$l_entry->check_out = date("H:i A",strtotime($l_entry->check_out));


			$balance = Entry::getAmount($l_entry->type,$hour,sizeof($e_ids));

			$l_entry->balance = $balance;
			$l_entry->total_balance = $l_entry->paid_amount+$l_entry->balance;
			$l_entry->hour = $hour;
			$data['l_entry'] = $l_entry;
			$data['success'] = true;
			$data['timeOut'] = true;
		}

		return Response::json($data, 200, []);
    }

    public function checkoutStore(Request $request){
    	$check_shift = Entry::checkShift();
    	$entry = Entry::find($request->id);


		$entry->status = 1; 
		$entry->checkout_status = 1;
		$entry->penality = $request->balance;
		$entry->checkout_date = date('Y-m-d H:i:s'); 
		$entry->save();

		$date = Entry::getPDate();


		DB::table('penalties')->insert([
			'entry_id' => $entry->id,
			'penalty_amount' => $request->balance,
			'pay_type' => $request->pay_type,
			'type' => $entry->type,
			'shift' => $check_shift,
			'date' =>$date,
			'added_by' =>Auth::id(),
			'user_session_id' => Auth::user()->session_id,
			'current_time' => date("H:i:s"),
			'created_at' => date('Y-m-d H:i:s'),
		]);

		$e_ids = explode(',', $request->e_ids);
		Entry::updateAvailStatus($entry->type,$e_ids);
		$data['success'] = true;
		
		return Response::json($data, 200, []);
    }
    
    public function delete($id){
    	DB::table('entries')->where('id',$id)->update([
    		'deleted' => 1,
    		'delete_by' => Auth::id(),
    		'delete_time' => date("Y-m-d H:i:s"),
    	]);

    	$data['success'] = true;
    	$data['message'] = "Successfully";

		return Response::json($data, 200, []);
	}


}
