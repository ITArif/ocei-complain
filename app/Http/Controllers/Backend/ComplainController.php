<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Complain;
use App\File_upload;
use Illuminate\Support\Facades\Session;

class ComplainController extends Controller
{
    public function allComplain(){
        Session::put('page','all-complain');
        $employees=DB::table('employee')->get();
        $complains=DB::table('file_upload')
        ->join('complain', 'complain.id', '=', 'file_upload.complain_id')
        ->select('file_upload.*', 'complain.name as name', 'complain.mobile as mobile','complain.reason as reason','complain.status as acomplain_status','file_upload.status as status','file_upload.admin_action as action','file_upload.employee_action as employee_action')
        ->whereIn('file_upload.status',[0,1,2,3])
        ->orderBy('id','DESC')
        ->get();

        $count = Complain::where('status','=','1')->count();
        //dd($count);
        //dd($visitors);
        return view('backend.complain.all_complain')->with(compact('complains','count','employees'));
    }

    public function viewComplain(Request $request, $id){
        $complains=DB::table('file_upload')
        ->join('complain', 'complain.id', '=', 'file_upload.complain_id')
        ->select('file_upload.*', 'complain.name as name','complain.email as email','complain.mobile as mobile','complain.reason as reason','complain.status as complain_status','file_upload.status as status','file_upload.admin_action as action','file_upload.employee_action as employee_action')
        ->where('file_upload.id',$id)
        ->get();
        //dd($complains);

        $employees=DB::table('employee')->get();
        return view('backend.complain.view_complain')
        ->with('complains',$complains)
        ->with('employees',$employees);
    }

    public function updateComplain(Request $request, $id){
        //dd($request->all());
        $updateComplain=File_upload::find($id);
        $updateComplain->admin_file=$request->admin_file;
        $updateComplain->status=$request->status;
        if(!empty($request->input('showcause_employee_id'))) {
                $updateComplain->showcause_employee_id = $request->showcause_employee_id;
            } else {
                $updateComplain->showcause_employee_id = 0;
         }
         if(!empty($request->input('employee_id'))) {
                $updateComplain->employee_id = $request->employee_id;
            } else {
                $updateComplain->employee_id = 0;
         }
        if(!empty($request->input('admin_action'))) {
                $updateComplain->admin_action = $request->admin_action;
            } else {
                $updateComplain->admin_action = 'Null';
         }

        if ($image = $request->file('admin_file')){
            $extension = $request->file('admin_file')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $path = public_path('uploads/');
            $image->move($path, $imageName);

            if(file_exists('uploads/'.$updateComplain->admin_file) AND !empty($updateComplain->admin_file)){
                unlink('uploads/'.$updateComplain->admin_file);
            }
        
        $updateComplain->admin_file = $imageName;
        // dd('ok');
        }else{
            $updateComplain->admin_file = "Null";
        }

        //dd($updateComplain);

        $updateComplain->save();
        return redirect('all-complain')->with('success','Successfully Complain Data Updated!');
    }

    public function forwardComplain(Request $request, $id){
        $allComplain=File_upload::where('id',$id)->first();
        $allComplain->employee_id=$request->employee_id;
        $allComplain->status=2;
        //dd($allComplain);
        $allComplain->save();

        return redirect()->back()->with('success','Successfully Complain Has been Forwarded!.');
    }

    public function allArchievedComplain(){
        Session::put('page','archieved-complain');
        $allArchievedComplains=DB::table('file_upload')
            ->join('complain', 'complain.id', '=', 'file_upload.complain_id')
            ->select('file_upload.*', 'complain.name as name','complain.email as email','complain.mobile as mobile','complain.reason as reason','complain.status as complain_status','file_upload.status as status','file_upload.admin_action as action','file_upload.employee_action as employee_action')
            ->where('file_upload.status',4)
            ->orderBy('id','DESC')
            ->get();
         //dd($allArchievedComplains);
        return view('backend.complain.all_archieved_complain')->with('allArchievedComplains',$allArchievedComplains);
    }

    public function archievedComplain(Request $request){
        $ids=$request->complainId;
        foreach ($ids as $id){
            $archieveddone = File_upload::find($id);
            if ($archieveddone){
                $archieveddone->status=4;
                $archieveddone->save();
            }
        }
        return response()->json('success',201);
    }
}
