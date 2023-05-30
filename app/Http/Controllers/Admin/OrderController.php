<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth ;
use DB;
use Mail;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
    $data['orderList']  = DB::table("order")
                        ->select("order.*")
                        ->leftJoin("order_details","order_details.order_id","=","order.order_id")
                        ->orderby('order.id','DESC')
                        ->groupBy('order.id')->get(); 
     return view("Admin.order_management.order_list")->with($data);
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

        $orderdetail = DB::table("order")
                      ->select("order.*")
                      ->leftJoin("order_details","order_details.order_id","=","order.order_id")
                      ->where('order.id',$id)
                      ->groupBy('order.id')
                      ->get();

        $card_details = DB::table("order_details")
                        ->select("order_details.*","cards.card_title","card_sizes.card_size","card_sizes.card_price As price","videos.qr_image_link")
                        ->leftJoin("order","order.order_id","=","order_details.order_id")
                        ->leftJoin("cards","cards.id","=","order_details.card_id")
                        ->leftJoin("card_sizes","card_sizes.id","=","order_details.card_size_id")
                        ->leftJoin("videos","videos.video_id","=","order_details.video_id")   
                        ->where('order.id',$id)                    
                        ->get();
                        
       $admindata = Auth::user();
    
                 
     return view("Admin.order_management.order_details",compact('orderdetail','admindata','card_details'));
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
    public function destroy(Request $request)
    {
        $list = Order::find($request->id);
        
        $result = $list->delete();
        
        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Order has been deleted successfully!'));
        } else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
        }
    }

    // Get order list by ajax
    public function getOrderList(Request $request)
    {
        // dd( $request->get('status_id'));
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

       // Custom search filter 
        $Stausid = $request->get('status_id');
        
        if( $Stausid != null)
        {
            $search_text = $request->input('search.value');
            $order_data  = DB::table('order')
                            ->leftJoin('users AS u','u.id','=','order.customer_id')
                            ->leftJoin('cards AS card','card.id','=','order.card_id')
                            ->select('order.*','card.card_title','card.price')
                            ->where('order.order_status',$Stausid)
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


            $totalFilteredRecord =  $order_data->count();
        }     
        elseif(empty($request->input('search.value')))
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
        // echo "3";
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

        $totalFilteredRecord = $order_data->count();
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
     $user_name ='';
	 $email_content = '';
     $cancel_reason = '' ;
     $date = date('Y-m-d H:i:s');

     if($request->cancel_reason)
     {
        $cancel_reason = $request->cancel_reason;
     }

     $getvalue = DB::table('order')->where('order_id',$order_id)->orderby('id',"DESC")->get();

     $card_data = DB::table("order_details")
                        ->select("order_details.*","cards.card_title","card_sizes.card_price As price","card_sizes.card_type","card_sizes.card_size")
                        ->leftJoin("order","order.order_id","=","order_details.order_id")
                        ->leftJoin("cards","cards.id","=","order_details.card_id")  
                        ->leftJoin("card_sizes","card_sizes.id","=","order_details.card_size_id")
                        ->where('order.order_id',$order_id)                    
                        ->get();

	 $user_id = $getvalue[0]->customer_id;

     $user_name = $getvalue[0]->fname.' '.$getvalue[0]->lname;

     $user_email = $getvalue[0]->email;
     

     $user_contact = $getvalue[0]->phone_no;
   
    
     $data = array(

        'user_name'=>$user_name,

        'user_email'=>$user_email,

        'user_contact'=>$user_contact,

        "order_dtl" => $getvalue ,
        "card_data" => $card_data
  
    );

     if($order_status == 1){

        Order::where('order_id',$order_id)->update(
            ['order_status' => $request->order_status,
              'cancel_reason' => $cancel_reason,
              'updated_at'=> $date,
        ]);

        $data['email_subject'] = 'Order Confirm';

        $data['email_content'] = 'Thank you for placing your order through Birthdaystore! Your order is now confirmed . Your Order No is :';

        $this->Send_status_email($data);

     }elseif($order_status==4){        
        Order::where('order_id',$order_id)->update(
            ['order_status' => $request->order_status,
              'cancel_reason' => $cancel_reason,
              'pay_status'=> 'Successful',
              'updated_at'=> $date,
        ]);
         
        $data['email_subject'] = 'Order Deliver';

        $data['email_content'] = 'Your order is Delivered.';

        $this->Send_status_email($data);

        }elseif($order_status==3){
            Order::where('order_id',$order_id)->update(
                ['order_status' => $request->order_status,
                  'cancel_reason' => $cancel_reason,
                  'updated_at'=> $date,
            ]);
        
            $data['email_subject'] = 'Order On the way';

            $data['email_content'] = 'Your order is On the way.';
    
            $this->Send_status_email($data);

        }elseif($order_status==2){
            Order::where('order_id',$order_id)->update(
                ['order_status' => $request->order_status,
                  'cancel_reason' => $cancel_reason,
                  'updated_at'=> $date,
            ]);
        
            $data['email_subject'] = 'Order Cancel';

            $data['email_content'] = 'Your Order is cancelled.';
    
            $this->Send_status_email($data);
        }
     
     return back()->with("success", "Status Changed Successfully");

    }


    Public function Send_status_email($data){
        
        if(!empty($data['user_email']))
        {
             Mail::send('Admin.email_template.orderstatus_newemail', $data, function ($message) use ($data) {

                $message->from('votivephp.neha@gmail.com','birthdaystore');

                $message->to($data['user_email']);

                $message->subject($data['email_subject']);

            });

        }
    }

}
