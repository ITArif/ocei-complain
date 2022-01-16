<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Complain;
use App\File_upload;
use DB;
use Image;

class ComplainController extends Controller
{
    public function showComplainForm(){
        $departments=DB::table('department')->get();
        $designations=DB::table('designation')->get();
        $employees=DB::table('employee')->get();
        return view('frontend.complain.complain')->with(compact('departments','designations','employees'));
    }

    public function storeComplain(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required|min:11|numeric',
            'reason'=>'required'
            ]);

            $uniqueTrackingNumber = rand(1000,9999);

            try {
                 DB::beginTransaction();

                 $complain=new Complain;
                 $complain->name=$data['name'];
                 $complain->mobile=$data['mobile'];
                 $complain->reason=$data['reason'];
                 $complain->tracking_number=$uniqueTrackingNumber;
                 $complain->status=0;
                 $complain->complain_against=$data['complain_against'];
                 $complain->branch_name=$data['branch_name'];
                 if(!empty($request->input('nid'))) {
                        $complain->nid = $request->nid;
                    } else {
                        $complain->nid = 'Null';
                 }
                if(!empty($request->input('email'))) {
                        $complain->email = $request->email;
                    } else {
                        $complain->email = 'Null';
                 }
                $complain->save();

                $file_upload=new File_upload;
                $file_upload->complain_id=$complain->id;
                $file_upload->tracking_number=$uniqueTrackingNumber;
                $file_upload->status=0;

                //For Single Image Upload
                if ($image = $request->file('complainer_file')) {
                $extension = $request->file('complainer_file')->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $path = public_path('uploads/');
                $image->move($path, $imageName);
                $file_upload->complainer_file = $imageName;
                } else {
                    $file_upload->complainer_file = "Null";
                }

                $file_upload->save();

                DB::commit();

                $msg = "Successfully Complain Data Inserted! Your tracking number is ".$uniqueTrackingNumber;
                return redirect()->back()->with('success',$msg);
            } catch (\Exception $e) {
                 //dd($e);
                DB::rollback();
                return back()->with('danger','Something Error Found, Please try again.');
            }
        }
    }

    public function trackComplain(Request $request){
        $mobile_number=$request->mobile;
        $tracking_number=$request->tracking_number;

        $trackComplains=DB::table('file_upload')
            ->join('complain', 'complain.id', '=', 'file_upload.complain_id')
            ->select('file_upload.*')
            ->where('complain.mobile', '=', $mobile_number)
            ->orWhere('file_upload.tracking_number', '=', $tracking_number)
            ->first();

        return view('frontend.complain.track_complain',compact('trackComplains'));

    }
}
