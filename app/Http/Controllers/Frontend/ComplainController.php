<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Complain;
use App\File_upload;
use DB;
use Image;
use Illuminate\Support\Facades\Http;

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
            'email'=>'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'mobile'=>'required|regex:/(01)[0-9]{9}/|size:11',
            'reason'=>'required'
            ]);
            
             if ($data['mobile']) {
                 $fourRandomDigit = rand(1000, 9999);
                $complainer_mobile = $data['mobile'];

                $complain_sms_sent_response = $this->sms_sent($complainer_mobile, $fourRandomDigit);
            }

            $uniqueTrackingNumber = rand(10000,99999);
            try {
                 DB::beginTransaction();

                 $complain=new Complain;
                 $complain->name=$data['name'];
                 $complain->mobile=$data['mobile'];
                 if ($complain_sms_sent_response != null) {
                     $complain->otp=$fourRandomDigit;
                 }
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

                return redirect()->route('showComplainOtpForm')->with('success','Sent an (OTP) in your mobile number and your complain tracking number is '.$uniqueTrackingNumber);
            } catch (\Exception $e) {
                 //dd($e);
                DB::rollback();
                return back()->with('danger','Something Error Found, Please try again.');
            }
        }
    }

    public function showComplainOtpForm(Request $request){

        return view('frontend.opt.show_otp_form');
    }

    public function otpVerificationComplain(Request $request){
        $otp=$request->otp;
        $complain_data=Complain::where('otp',$otp)->first();
        if ($complain_data != null) {
            Complain::where('otp', $otp)
            ->update([
                'otp' => '',
                'status'=>1
            ]);
        }else{
           return back()->with('danger','Your otp is invalid.');
        }
        return redirect()->route('complain-form')->with('success','Submit Successfully your complain');
    }


    public function sendOTPToComplainer(Request $request)
    {
        $complainerMobileNumber = Complain::where('mobile', $request->mobile)->first();

        if ($complainerMobileNumber) {
            return response()->json("mobileExists");
        }

        $fourRandomDigit = rand(1000, 9999);
        $complainerMobile = $request->mobile;
        $body_sms = $fourRandomDigit . " is your (OTP) to complain.";

        $complain_sms_sent_response = $this->sms_sent($complainerMobile, $body_sms);
        if ($complain_sms_sent_response) {
            return response()->json($fourRandomDigit);
        } else {
            return response()->json("error");
        }
        // dd($complain_sms_sent_response);
    }

    public function sms_sent($mobile, $otpCode)
    {

        $response = Http::post('http://206.189.158.212/EACEI/oceisms.php?mobile='.$mobile.'&otp='.$otpCode);

        return $response;
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
        //dd($trackComplains);

        return view('frontend.complain.track_complain',compact('trackComplains'));

    }

    public function aboutOcci(){
        return view('frontend.complain.about_occi');
    }

}
