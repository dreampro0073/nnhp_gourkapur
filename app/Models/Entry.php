<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

class Entry extends Model
{

    protected $table = 'entries';

    public static function payTypes(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'Cash'];
        $ar[] = ['value'=>2,'label'=>'UPI'];

        return $ar;
    }

    public static function getAvailPods(){
        return DB::table('pods')->where('status',0)->get();
    }

    public static function getAvailSinCabins(){
        return DB::table('single_cabins')->where('status',0)->get();
    }

    public static function getAvailBeds(){
        return DB::table('double_beds')->where('status',0)->get();
    }

    public static function getAvailPodsAr(){
        return DB::table('pods')->where('status',0)->pluck('id')->toArray();
    }

    public static function getAvailSinCabinsAr(){
        return DB::table('single_cabins')->where('status',0)->pluck('id')->toArray();
    }

    public static function getAvailBedsAr(){
        return DB::table('double_beds')->where('status',0)->pluck('id')->toArray();
    }

    public static function showPayTypes(){
        return [1=>'Cash',2=>"UPI"];
    }

    public static function hours(){
        $ar = [];
        $ar[] = ['value'=>6,'label'=>6];
        $ar[] = ['value'=>12,'label'=>12];
        $ar[] = ['value'=>24,'label'=>24];
        
        return $ar;
    }

    public static function days(){
        $ar = [];
        for ($i=1; $i <= 15; $i++) { 
           $ar[] = ['value'=>$i,'label'=>$i];
        }
        return $ar;
    }

    public static function checkShift($type = 1){
        $a_shift = strtotime("06:00:00");
        $b_shift =strtotime("14:00:00");
        $c_shift =strtotime("22:00:00");

        $current_time = strtotime(date("H:i:s"));

        if($current_time > $a_shift && $current_time < $b_shift){

            if($type == 1){
                return "A";
            } else {
                return "C";
            }

        }else if($current_time > $b_shift && $current_time < $c_shift){
            if($type == 1){
                return "B";
            } else {
                return "A";
            }
        }else{
            if($type == 1){
                return "C";
            } else {
                return "B";
            }
        }

    }

    public static function totalShiftData($type = 1){
        $check_shift = Entry::checkShift();
        
        $total_shift_cash = 0;
        $total_shift_upi = 0;       

        $last_hour_cash_total = 0;
        $last_hour_upi_total = 0;

        $from_time = date('H:00:00');
        $to_time = date('H:59:59');

        $p_date = Entry::getPDate();
        $shift_date = date("d-m-Y",strtotime($p_date));

        $total_shift_upi = Entry::where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('deleted',0)->where('pay_type',2)->sum("paid_amount");

        $total_shift_upi += DB::table('penalties')->where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('pay_type',2)->sum("penalty_amount");

        $total_shift_cash = Entry::where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('deleted',0)->where('pay_type',1)->sum("paid_amount");
        $total_shift_cash += DB::table('penalties')->where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('pay_type',1)->sum("penalty_amount");

        $last_hour_upi_total = Entry::where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('deleted',0)->where('pay_type',2)->where('created_at', '>=', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 HOUR)'))->sum("paid_amount"); 
        $last_hour_upi_total += DB::table('penalties')->where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('pay_type',2)->where('created_at', '>=', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 HOUR)'))->sum("penalty_amount"); 
        
        $last_hour_cash_total = Entry::where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('deleted',0)->where('pay_type',1)->where('created_at', '>=', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 HOUR)'))->sum("paid_amount");
        $last_hour_cash_total += DB::table('penalties')->where('type',$type)->where('user_session_id',Auth::user()->session_id)->where('pay_type',1)->where('created_at', '>=', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 HOUR)'))->sum("penalty_amount");

        $total_collection = $total_shift_upi + $total_shift_cash;
        $last_hour_total = $last_hour_upi_total + $last_hour_cash_total;

        $data['total_shift_upi'] = $total_shift_upi;
        $data['total_shift_cash'] = $total_shift_cash;
        $data['total_collection'] = $total_collection;

        $data['last_hour_upi_total'] = $last_hour_upi_total;
        $data['last_hour_cash_total'] = $last_hour_cash_total;
        $data['last_hour_total'] = $last_hour_total;
        $data['check_shift'] = $check_shift;
        $data['shift_date'] = $shift_date;

        return $data;
    }

    public static function getPDate(){
        $p_date = date("Y-m-d");
        return $p_date;
    }

    public static function updateAvailStatus($type,$ids){
        if($type == 1){
            DB::table('pods')->whereIn('id',$ids)->update([
                'status' => 0,
            ]);
        }
        if($type == 2){
            DB::table('single_cabins')->whereIn('id',$ids)->update([
                'status' => 0,
            ]);
        }
        if($type == 3){
            DB::table('double_beds')->whereIn('id',$ids)->update([
                'status' => 0,
            ]);
        }
        return 'done';
       
    }

    public static function getAmount($type,$hour,$size){
        $balance= 0;
        if($type == 1){
            if($hour > 1 && $hour <= 6){
                $balance = 299*$size;
            }else if($hour > 6 && $hour <= 12){
                $balance = 499*$size;

            }else if($hour > 12 && $hour <= 24){
                $balance = 799*$size;   
            }
            // dd($balance);
            
        }
        if($type == 2){
            if($hour > 1 && $hour <= 6){
                $balance = 399*$size;
            }else if($hour > 6 && $hour <= 12){
                $balance = 599*$size;

            }else if($hour > 12 && $hour <= 24){
                $balance = 1199*$size;   
            }

        }
        if($type == 3){
            if($hour > 1 && $hour <= 6){
                $balance = 599*$size;
            }else if($hour > 6 && $hour <= 12){
                $balance = 899*$size;

            }else if($hour > 12 && $hour <= 24){
                $balance = 1699*$size;   
            }
        }
        return $balance;
       
    }


}