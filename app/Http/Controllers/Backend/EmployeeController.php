<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Complain;
use App\File_upload;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function forwardingComplain(){
        Session::put('page','forwar-complain');
        $employee_id = session('user_id');
        $forwardingComplains=DB::table('file_upload')
        ->join('complain', 'complain.id', '=', 'file_upload.complain_id')
        ->select('file_upload.*', 'complain.name as name','complain.email as email','complain.mobile as mobile','complain.reason as reason','complain.status as complain_status','file_upload.status as status','file_upload.admin_action as action','file_upload.employee_action as employee_action')
        ->where('file_upload.employee_id',$employee_id)
        ->orderBy('id','DESC')
        ->get();
        //dd($forwardingComplains);
        return view('backend.employee.all_forwar_complainer')->with(compact('forwardingComplains'));
    }

    public function employeeViewComplain(Request $request, $id){
        $employee_id = session('user_id');
        $complains=DB::table('file_upload')
            ->join('complain', 'complain.id', '=', 'file_upload.complain_id')
            ->select('file_upload.*', 'complain.name as name','complain.email as email','complain.mobile as mobile','complain.reason as reason','complain.status as complain_status','file_upload.status as status','file_upload.admin_action as action','file_upload.employee_action as employee_action')
            ->where('file_upload.id',$id)
            ->where('file_upload.employee_id',$employee_id)
            ->get();
        //dd($complains);
        return view('backend.employee.employee_view_complain')->with('complains',$complains);
    }

    public function employeeUpdateComplain(Request $request, $id){
        //dd($request->all());
        $updateComplain=File_upload::find($id);
        $updateComplain->employee_file=$request->employee_file;
        $updateComplain->status=2;
        if(!empty($request->input('employee_action'))) {
            $updateComplain->employee_action = $request->employee_action;
        } else {
            $updateComplain->employee_action = 'Null';
        }

        if ($image = $request->file('employee_file')){
            $extension = $request->file('employee_file')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $path = public_path('uploads/');
            $image->move($path, $imageName);

            if(file_exists('uploads/'.$updateComplain->employee_file) AND !empty($updateComplain->employee_file)){
                unlink('uploads/'.$updateComplain->employee_file);
        }
        
        $updateComplain->employee_file = $imageName;
        // dd('ok');
        }else{
            $updateComplain->employee_file = "Null";
        }
        //dd($updateComplain);
        $updateComplain->save();
        return redirect('all-forward-complain')->with('success','Successfully Complain Data Updated!');
    }
}
