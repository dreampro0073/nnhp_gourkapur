<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\Massage, App\Models\User;
use App\Models\Entry;

class EntryOldController extends Controller {	
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
	public function allEntries(){
		$sidebar = 'all-entries';
        $subsidebar = 'all-entries';

		return view('admin.entries.all_entries', [
            "sidebar" =>$sidebar,
            "subsidebar" => $subsidebar,
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
		
		$entries = $entries->where('checkout_status',0)->where('type',$type);
		$entries = $entries->orderBy('id', "DESC")->get();

		foreach ($entries as $key => $item) {
			$bm_amount = DB::table('e_entries')->where('entry_id','=',$item->id)->sum('paid_amount');
			$item->sh_paid_amount = $item->paid_amount + $bm_amount;
			$item->check_in = date("d M y",strtotime($item->check_in));
			$item->checkout_date = date("d M y, h:i A",strtotime($item->checkout_date));
		}

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
	public function initAllEntry(Request $request){
		

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
		
		$entries = $entries->orderBy('id', "DESC")->get();

		foreach ($entries as $key => $item) {
			$bm_amount = DB::table('e_entries')->where('entry_id','=',$item->id)->sum('paid_amount');
			$item->sh_paid_amount = $item->paid_amount + $bm_amount;
			$item->check_in = date("d M y",strtotime($item->check_in));
			$item->checkout_date = date("d M y, h:i A",strtotime($item->checkout_date));
		}

		$data['success'] = true;
		$data['entries'] = $entries;

		return Response::json($data, 200, []);
	}
	
	public function editEntry(Request $request){
		$l_entry = Entry::where('id', $request->entry_id)->first();

		$sl_pods = [];
		$sl_cabins = [];
		$sl_beds = [];

		if($l_entry){
			$l_entry->mobile_no = $l_entry->mobile_no*1;
			$l_entry->train_no = $l_entry->train_no*1;
			$l_entry->pnr_uid = $l_entry->pnr_uid;
			$l_entry->paid_amount = $l_entry->paid_amount*1;
			$l_entry->total_amount = $l_entry->total_amount*1;
			$l_entry->discount_amount = $l_entry->discount_amount*1;

			$l_entry->check_in = date("h:i A",strtotime($l_entry->check_in));
			$l_entry->check_out =date("h:i A",strtotime($l_entry->check_out));

			$e_ids =  explode(',', $l_entry->e_ids);
			
			if($l_entry->type == 1){
				$sl_pods = $e_ids;

			}else if($l_entry->type == 2){
				$sl_cabins = $e_ids;

			}else{
				$sl_beds = $e_ids;
			}

			$bm_amount = DB::table('e_entries')->where('entry_id','=',$l_entry->id)->sum('paid_amount');
			$l_entry->paid_amount = $l_entry->paid_amount + $bm_amount;
			$l_entry->bm_amount = $bm_amount;
		}

		$data['success'] = true;
		$data['l_entry'] = $l_entry;
		$data['sl_pods'] = $sl_pods;
		$data['sl_cabins'] = $sl_cabins;
		$data['sl_beds'] = $sl_beds;
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

		$user_session_id = Auth::user()->session_id;
		$user_id = Auth::id();

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
			$paid_amount = $request->paid_amount;
			$balance_amount = $request->balance_amount;
			if($request->id){
				
				$entry = Entry::find($request->id);
				$message = "Updated Successfully!";

				
				if($user_session_id != $entry->user_session_id){
					DB::table('e_entries')->insert([
						'entry_id' => $entry->id,
						'added_by' => $user_id,
						'user_session_id' => $user_session_id,
						'date' => date("Y-m-d"),
						'pay_type' => $request->pay_type,
						'type' => $type,
						'shift' => $check_shift,
						'paid_amount' => $request->balance_amount,
						'created_at' => date("Y-m-d H:i:s"),
						'current_time' => date("H:i:s"),
					]);
				}else{
					$paid_amount = $paid_amount + $balance_amount;
					$entry->paid_amount = $paid_amount;
				}
			} else {
				$entry = new Entry;
				$message = "Stored Successfully!";
				$entry->unique_id = strtotime('now');
				$entry->paid_amount = $paid_amount;

				$entry->added_by = $user_id;
				$entry->user_session_id = $user_session_id;
				$entry->pay_type = $request->pay_type;

				$entry->created_at = date('Y-m-d H:i:s');

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
			
			$entry->total_amount = $total_amount;
			$entry->discount_amount = $request->has('discount_amount')?$request->discount_amount:0;

			$entry->remarks = $request->remarks;
			$entry->shift = $check_shift;
			$entry->type = $type;
			$entry->save();
			$no_of_min = $request->hours_occ*60;
			$no_of_min = $no_of_min - 1;

			$entry->check_out = date("H:i:s",strtotime("+".$no_of_min." minutes",strtotime($entry->check_in)));

			$date = Entry::getPDate();
	        $entry->date = $date;
			$checkin_date = $date." ".$entry->check_in;
			$checkout_date = date("Y-m-d H:i:s",strtotime("+".$no_of_min.' minutes',strtotime($checkin_date)));

	        $entry->checkout_date = $checkout_date;
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
    	$checkout_time = strtotime($l_entry->checkout_date);

    	if($checkout_time > $now_time){
    		$data['timeOut'] = false;
    		$entry = Entry::find($request->entry_id);
    		$entry->status = 1; 
    		$entry->checkout_status = 1; 
    		$entry->save();
    		$data['success'] = true;

			$e_ids = explode(',', $l_entry->e_ids);

			Entry::updateAvailStatus($l_entry->type,$e_ids);    
    	} else {
    		$hour = round(($now_time - $checkout_time)/(60 * 60));
    		$e_ids = explode(',', $l_entry->e_ids);

			$l_entry->mobile_no = $l_entry->mobile_no*1;
			$l_entry->pnr_uid = $l_entry->pnr_uid;
			$l_entry->paid_amount = $l_entry->paid_amount*1;

			$l_entry->check_in = date("H:i A",strtotime($l_entry->check_in));
			$l_entry->check_out = date("H:i A",strtotime($l_entry->check_out));


			$balance = Entry::getAmount($l_entry->type,$hour,sizeof($e_ids));
			// dd($balance);
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


		DB::table('e_entries')->insert([
			'entry_id' => $entry->id,
			'paid_amount' => $request->balance,
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

    	$entry = DB::table('entries')->where('id',$id)->first();
    	$e_ids = [];
    	if($entry){
    		$e_ids = explode(',', $entry->e_ids);
    	}

    	
    	DB::table('entries')->where('id',$id)->update([
    		'deleted' => 1,
    		'delete_by' => Auth::id(),
    		'delete_time' => date("Y-m-d H:i:s"),
    	]);

		Entry::updateAvailStatus($entry->type,$e_ids);

    	$data['success'] = true;
    	$data['message'] = "Successfully";

		return Response::json($data, 200, []);
	}


}
