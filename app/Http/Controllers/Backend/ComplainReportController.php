<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class ComplainReportController extends Controller
{
    public function allReports(Request $request){
        Session::put('page','report-complain');
        $from_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
        $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
        //dd($from_date);

        $allComplainReports=DB::table('complain')
            ->join('file_upload', 'complain.id', '=', 'file_upload.complain_id')
            ->select('complain.*', 'file_upload.status as status','file_upload.admin_action as admin_action','file_upload.employee_action as employee_action','file_upload.complainer_file as complainer_file','file_upload.admin_file as admin_file','file_upload.employee_file as employee_file')
            ->where('file_upload.status',4)
            ->orderBy('id','DESC')
            ->get(); 

        //dd($allComplainReports);

        if ($request->isMethod('post')) {

            if (($from_date && $to_date)) {
                //dd($from_date);
                $allComplainReports=DB::table('complain')
                    ->join('file_upload', 'complain.id', '=', 'file_upload.complain_id')
                   ->select('complain.*', 'file_upload.status as status','file_upload.admin_action as admin_action','file_upload.employee_action as employee_action','file_upload.complainer_file as complainer_file','file_upload.admin_file as admin_file','file_upload.employee_file as employee_file')
                    ->where('file_upload.status',4)
                    ->whereBetween('complain.created_at', [$from_date, $to_date])
                    ->get(); 
                //dd($allComplainReports);

                return view('backend.all_reports.all_complain_reports', compact('allComplainReports'));
            }
        }
        return view('backend.all_reports.all_complain_reports',compact('allComplainReports'));
    }

    public function generateComplainPdf($complain_id)
    {
        // $data['generateComplainPDF'] = DB::table('file_upload')
        //     ->leftJoin('complain', 'file_upload.complain_id', '=', 'complain.id')
        //     ->where('file_upload.complain_id', $complain_id)
        //     ->first();
        $data['generateComplainPDF']=DB::table('complain')
            ->join('file_upload', 'complain.id', '=', 'file_upload.complain_id')
            ->select('complain.*', 'file_upload.status as status','file_upload.admin_action as admin_action','file_upload.employee_action as employee_action','file_upload.complainer_file as complainer_file','file_upload.admin_file as admin_file','file_upload.employee_file as employee_file')
            ->where('file_upload.complain_id', $complain_id)
            ->first();

         //dd($data['generateComplainPDF']);

        return view('backend.all_reports.complainPdf', $data);
    }

}
