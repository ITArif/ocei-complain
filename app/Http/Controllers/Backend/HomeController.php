<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Complain;
use App\File_upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function dashboard(){
        Session::put('page','dashboard');
        $totalComplains = Complain::count();
        $totalActionComplains=File_upload::whereIn('status',[1,2,3,4])->count();
        $totalForwardComplains=File_upload::where('status',1)->count();
        $totalCancelComplains=File_upload::where('status',3)->count();
        //dd($totalActionComplains);
        return view('backend.dashboard.dashboard',compact('totalComplains','totalActionComplains','totalForwardComplains','totalCancelComplains'));
    }

    public function profile(){
        return view('backend.profile.profile');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'user_name'=>'required'
        ]);
          $id=Session::id();
          $visitors=User::find($id);
          $visitors->user_name=$request->user_name;
          $visitors->save();
          //Session::flash('success','Successfully Profile Updated');
          return redirect()->back()->with('success','Successfully Profile Updated!');
    }

     //Update password
    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required||min:6|confirmed',
            // 'password_confirmation'=>'required|same:new_password',
        ]);
        $hashedPassword=Auth::user()->password;
        //dd($hashedPassword);
        if(Hash::check($request->old_password,$hashedPassword)){
                if(! Hash::check($request['password'],$hashedPassword)){
                $visitors = VisitorAdmin::find(Auth::guard('system_admin')->user()->id);
                $visitors->password = Hash::make($request->password);
                $visitors->save();
                Session::flash('success','You Have Successfully Changed The Password');
                Auth::logout();
                return redirect()->route('visitor.login');
               }else{
                Session::flash('error','New Password Cannot Be The Same As Old Pass');
                return redirect()->back();
               }
        }else{
            Session::flash('error','Old Password Does Not Matched');
            return redirect()->back();
        }
    }

}
