<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth ;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view("Admin.order_management.order_list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetail = DB::table('order')
                    ->leftJoin('users AS u','u.id','=','order.customer_id')
                    ->leftJoin('cards AS card','card.id','=','order.card_id')
                    ->select('order.*','card.card_title','card.price','u.email','u.phone')
                    ->where('order.id',$id)
                    ->get(); 
       $admindata=Auth::user();
                 
     return view("Admin.order_management.order_details",compact('orderdetail','admindata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Get order list
    public function getOrderList(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'booking_id',
        3=> 'card_title',
        4=> 'customer_id',
        5=> 'customer_name',
        6=> 'booking_price', 
        7=> 'booking_status',                             
        8=> 'action'
        ); 
                  
        $totalDataRecord = Order::count();
    
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
   
        $order_data  = DB::table('order')
                        ->leftJoin('users AS u','u.id','=','order.customer_id')
                        ->leftJoin('cards AS card','card.id','=','order.card_id')
                        ->select('order.*','card.card_title','card.price')
                        ->offset($start_val)
                        ->limit($limit_val)
                        ->orderBy('order.id', 'ASC')
                        // ->orderBy($order_val,$dir_val)
                        ->get();   
        
        }
        else {
        $search_text = $request->input('search.value');

        if($search_text == 'pending')
        {
            $search_text = 0 ;
        }elseif($search_text == 'Accept'){
            $search_text = 1 ;
        }elseif($search_text == 'Cancelled'){
            $search_text = 2 ;
        }elseif($search_text == 'On the way'){
            $search_text = 3 ;
        }else{
            $search_text = 4;
        }

        $order_data = DB::table('order')
                        ->leftJoin('users AS u','u.id','=','order.customer_id')
                        ->leftJoin('cards AS card','card.id','=','order.card_id')
                        ->select('order.*','card.card_title','card.price')
                        ->where(function ($query) use ($search_text) {
                            $query->where('order.order_id', 'LIKE',"%{$search_text}%")
                            ->orWhere('order.fname', 'LIKE',"%{$search_text}%")
                            ->orWhere('order.lname', 'LIKE',"%{$search_text}%")
                            ->orWhere('order.customer_id', 'LIKE',"%{$search_text}%")
                            ->orWhere('card.price', 'LIKE',"%{$search_text}%")
                            ->orWhere('order.order_status', 'LIKE',"%{$search_text}%")
                            ->orWhere('card.card_title', 'LIKE',"%{$search_text}%");
                            })
                        ->offset($start_val)
                        ->limit($limit_val)
                        ->orderBy('order.id', 'ASC')
                        // ->orderBy($order_val,$dir_val)
                        ->get();

        $totalFilteredRecord = DB::table('order')
                            ->leftJoin('users AS u','u.id','=','order.customer_id')
                            ->leftJoin('cards AS card','card.id','=','order.card_id')
                            ->select('order.*','card.card_title','card.price')
                            ->where(function ($query) use ($search_text) {
                                $query->where('order.order_id', 'LIKE',"%{$search_text}%")
                                ->orWhere('order.fname', 'LIKE',"%{$search_text}%")
                                ->orWhere('order.lname', 'LIKE',"%{$search_text}%")
                                ->orWhere('order.customer_id', 'LIKE',"%{$search_text}%")
                                ->orWhere('card.price', 'LIKE',"%{$search_text}%")
                                ->orWhere('order.order_status', 'LIKE',"%{$search_text}%")
                                ->orWhere('card.card_title', 'LIKE',"%{$search_text}%");
                                })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('order.id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->count();

        }
            
        $data_val = array();
        if(!empty($order_data))
        {
            $i = $start_val+1;
      
        foreach ($order_data as $value)
        {
                
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['booking_id'] = $value->order_id;  
            $nestedData['card_title'] = $value->card_title; 
            $nestedData['customer_id'] = $value->customer_id;   
            $nestedData['customer_name'] = $value->fname." ".$value->lname ;  
            $nestedData['booking_price'] = '$'.number_format($value->price * $value->card_qty, 2); 
            
            if($value->order_status == 0){
             $nestedData['booking_status'] = 'Pending'; 
            } elseif ($value->order_status == 1){
                $nestedData['booking_status'] = 'Accept'; 
            }elseif ($value->order_status == 2){
                $nestedData['booking_status'] = 'Cancelled'; 
            }elseif ($value->order_status == 3){
                $nestedData['booking_status'] = 'On the way'; 
            }else{
                $nestedData['booking_status'] = 'Delivered'; 
            }

  
            $nestedData['action'] = '         
            <button class="btn btn-dark p-2">
            <a href="'.route('order-detail',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>';
            
            $data_val[] = $nestedData;

            $i++;
                    
        }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
        "draw"            => intval($draw_val),
        "recordsTotal"    => intval($totalDataRecord),
        "recordsFiltered" => intval($totalFilteredRecord),
        "data"            => $data_val
        );
            
        echo json_encode($get_json_data);  
 
    }

    public function OrderstatusChange(Request $request)
    {
       
     $order_id = $request->order_id;
     $order_status =  $request->order_status;

     $getvalue = DB::table('order')->where('order_id',$order_id)->first();

	 $user_id = $getvalue->customer_id;
     $cancel_reason = '' ;
     $date = date('Y-m-d H:i:s');
     if($order_status==1){

        // $carddata = DB::table('users_card')->where('order_id',$order_id)->where('user_id',$getvalue->user_id)->where('transaction_type','05')->first();
       //  if(!empty($carddata)){
        // $data = array(
        //   'gateway_id'=> 'G15552-42',
        //   'password'=> "V2wX5h1ov8iar0FR7ScRaePz2xZemfnF",
        //   'transaction_type'=> '00',
        //   'amount'=> $carddata->amount,
        //   'cardholder_name'=> $carddata->cardholder_name,
        //   'cc_number'=> $carddata->cc_number,
        //   'cc_expiry'=> $carddata->cc_expiry,
        //   'cvd_code'=> $carddata->cvd_code,
        //   'cvd_presence_ind'=> '1',
        //   'reference_no'=> $carddata->reference_no,
        //   'customer_ref'=> $order_id,
        //   'currency_code'=> 'USD',
        //   'credit_card_type'=> $carddata->credit_card_type,

        // );

        // $payload = json_encode($data, JSON_FORCE_OBJECT);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://api.globalgatewaye4.firstdata.com/transaction",
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS =>$payload,
        // CURLOPT_HTTPHEADER => array(
        //     "Content-Type: application/json"
        // ),
        // ));


        // $json_response = curl_exec($curl);	

        // $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // $response = json_decode($json_response, true);

        // curl_close($curl);

        // $cc_number = substr($carddata->cc_number,-4,4);

        // if($response['transaction_approved']=='1'){

        // DB::table('users_card')->where('order_id',$order_id)->where('user_id',$getvalue->user_id)->update([

        //     'cc_number' => $cc_number,
        //     'cvd_code' => '000',
        //     'transaction_type' => $response['transaction_type'],
        //     'transaction_tag' =>  strval($response['transaction_tag']),
        //     'authorization_num' => $response['authorization_num'],
        //     'transaction_approved' => $response['transaction_approved'],
        //     'bank_message' => $response['bank_message'],
        //     'updated_at' => date('Y-m-d H:i:s')

        //     ]);

        // Session::flash('message', 'Payment has been successfully processed');

        // }else{

        // Session::flash('errormsg', $json_response); 	

        // return redirect()->to('/merchant/order-details/'.$id); // return redirect()->to('/merchant/order-list/'); 

        // }

        // }


     }

     if($request->cancel_reason)
     {
        $cancel_reason = $request->cancel_reason;
     }

     if($order_status==4){        
        Order::where('order_id',$order_id)->update(
            ['order_status' => $request->order_status,
              'cancel_reason' => $cancel_reason,
              'pay_status'=> 'Successful',
              'updated_at'=> $date,
        ]);
        }else{
            Order::where('order_id',$order_id)->update(
                ['order_status' => $request->order_status,
                  'cancel_reason' => $cancel_reason,
                  'updated_at'=> $date,
            ]);

        }
     
     return back()->with("success", "Status Changed Successfully!");

    }


}
