<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use DB,Validator;
use Hash;
use Auth;

class OrdertrackingController extends Controller{

	public function index(){
		return view('Front/order_track');
	}

	public function trackorder_submit(Request $request){
		$data['track_order_data'] = DB::table("order")->where("order_id",$request->order_no)->where("email",$request->email_phone)->orWhere("phone_no",$request->email_phone)->get()->first();
		if(!empty($data['track_order_data'])){
			return view('Front/order_track_data')->with($data);
		}else{
			echo "<p>No data found</p>";
		}
		
	}
}