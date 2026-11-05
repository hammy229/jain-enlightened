<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class BankDetailController extends Controller
{
    public function index(Request $request){
        $bank_details = Admin\Donate::where('status', 'active')->select('id', 'bank_name', 'account_holder_name', 'account_number', 'ifsc_code', 'scanner_heading_1', 'scanner_img_path_1', 'scanner_img_name_1', 'scanner_heading_2', 'scanner_img_path_2', 'scanner_img_name_2')->orderBy('id', 'desc')->get();
        $bank_details->map(function($bank_detail){
            $bank_detail->scanner_img_path_1 = !empty($bank_detail->scanner_img_path_1) && Storage::exists($bank_detail->scanner_img_path_1) ? url('/').Storage::url($bank_detail->scanner_img_path_1) : '';
            $bank_detail->scanner_img_path_2 = !empty($bank_detail->scanner_img_path_2) && Storage::exists($bank_detail->scanner_img_path_2) ? url('/').Storage::url($bank_detail->scanner_img_path_2) : '';
        });
        $data = [
            'bank_details' => $bank_details
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
