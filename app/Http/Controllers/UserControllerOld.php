<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB,DateTime;

use App\Models\User;
use Carbon\Carbon;
use Crypt;

use Dompdf\Dompdf;
use Dompdf\Options;

class UserControllerOld extends Controller {

    public function index(){
        return Redirect::to('admin/dashboard');
        return view('index');
    }

    public function users(){
        $sidebar = 'users';
        return view('admin.users.index',compact('sidebar'));
    }

   
    public function print(){
        return view('admin.print_page');
    }

   

  
    public function testx(){
        $start_date = "02-01-2024";
    }

	public function login(){    
		return view('login');
	}


	public function postLogin(Request $request){
		$cre = ["email"=>$request->input("email"),"password"=>$request->input("password")];
		$rules = ["email"=>"required","password"=>"required"];
		$validator = Validator::make($cre,$rules);

        $flag = false;
        $now_time = strtotime(date("H:i:s"));
        // $now_time = strtotime("01:05:00");
        $c_shift_start_time = strtotime("00:00:00");
        $c_shift_end_time = strtotime("06:00:00");
        if($now_time > $c_shift_start_time && $now_time < $c_shift_end_time){
            $flag = true;
        }else{
            $flag = false;
        }

        $today = date("Y-m-d");
        if($flag){
            $today =  date("Y-m-d",strtotime("-1 day",strtotime($today)));
        }

        // dd($today);
        // $startDate = Carbon::createFromFormat('H:i:s','22:00:00');
        // $endDate = Carbon::createFromFormat('H:i:s','06:00:00');
        // $check = Carbon::now()->between($startDate, $endDate, true);
        // if($check){
        //     dd('In Between');
        // }else{
        //     dd('In Not Between');
        // }


        if($validator->passes()){

			
            if(Auth::attempt($cre)){
                

                $check = DB::table('user_sessions')->where('user_id',Auth::id())->where('date',$today)->first();

                if($check){
                    return Redirect::to('admin/dashboard');

                }else{
                    $session_id = strtotime("now");
                    $id = DB::table("user_sessions")->insertGetId([
                        'user_id' => Auth::id(),
                        'session_id' => $session_id,
                        'date' => $today,
                    ]);
                    $ses = DB::table('user_sessions')->where('id',$id)->first();
                    DB::table("users")->where('id',Auth::id())->update([
                        'session_id' => $ses->session_id,
                    ]);
                    return Redirect::to('admin/dashboard');
                }

			} else {
                return Redirect::back()->withInput()->with('failure','Invalid username or password');
			}

		} else {
            return Redirect::back()->withErrors($validator)->withInput();
		}

	}

    public function resetPassword(){
        $sidebar = 'change_pass';
        return view('admin.users.reset_password',compact('sidebar'));
    }

    public function updatePassword(Request $request){
        $cre = ["old_password"=>$request->old_password,"new_password"=>$request->new_password,"confirm_password"=>$request->confirm_password];
        $rules = ["old_password"=>'required',"new_password"=>'required|min:5',"confirm_password"=>'required|same:new_password'];
        $old_password = Hash::make($request->old_password);
        $validator = Validator::make($cre,$rules);
        if ($validator->passes()) { 
            if (Hash::check($request->old_password, Auth::user()->password )) {
                $password = Hash::make($request->new_password);
                $user = User::find(Auth::id());
                $user->password = $password;
                $user->password_check = $request->new_password;
                $user->save();
                
                return Redirect::back()->with('success', 'Password changed successfully ');
                
            } else {
                return Redirect::back()->withInput()->with('failure', 'Old password does not match.');
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::back()->withErrors($validator)->withInput()->with('failure','Unauthorised Access or Invalid Password');
    }


    public function initUsers(Request $request){
        $users = DB::table('users')->select('id','name','email','mobile');

        if($request->name){
            $users = $users->where('name','LIKE','%'.$request->name.'%');
        }
        if($request->email){
            $users = $users->where('email','LIKE','%'.$request->email.'%');
        }
        if($request->mobile){
            $users = $users->where('mobile','LIKE','%'.$request->mobile.'%');
        }
        $users = $users->get();

        $data['success'] = true;
        $data['users'] = $users;
        
        return Response::json($data, 200, []);
    }

    public function editUser(Request $request){
        $user = User::find($request->user_id);
        if($user){
            $user->mobile = $user->mobile*1;
        }

        $data['success'] = true;
        $data['user'] = $user;

        return Response::json($data, 200, []);

    }

    public function storeUser(Request $request){


        $cre = [
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
        ];

        $rules = [
            'name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
        ];

        if(!$request->has('id')){
            $rules['email'] = 'required|unique:users';
        }

        if(!$request->has('id')){
            $cre['password'] = $request->password;
            $cre['confirm_password'] = $request->confirm_password;

            $rules['password'] = 'required';
            $rules['confirm_password'] = 'required|same:password';

            
        }  

        $validator = Validator::make($cre,$rules);

        if($validator->passes()){
            
            if($request->id){
                $user = User::find($request->id);
                $data['message'] = 'Successfully Updated';

            } else {
                $user = new User;
                $user->password_check = $request->password;
                $user->password = Hash::make($request->password);
                $data['message'] = 'successfully Added';   
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;    
            if(Auth::user()->priv !=1){
                $user->priv = 2;    
            }    
            
            $user->save();
            $data['success'] = true;

        } else {
            $data['success'] = false;
            $message = $validator->errors()->first();
            $data['message'] = $message;
        }

        return Response::json($data, 200, []);

    }
    
}