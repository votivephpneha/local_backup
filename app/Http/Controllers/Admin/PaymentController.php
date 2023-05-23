<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['payhisList'] = PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
                            ->join('order', 'order.id', '=', 'payment_transactions.order_id')
                            ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","order.order_id as order_id1")
                            ->orderby('payment_transactions.id','DESC')
                            ->get();

     return  view('Admin.payment_history.payment_transaction_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
     $paytrandata = PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
     ->join('order', 'order.id', '=', 'payment_transactions.order_id')
     ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","users.phone","users.email","users.address","order.order_id as order_id1","order.order_status")       
     ->where('payment_transactions.id',$id)
     ->get();
    
     return  view('Admin.payment_history.view_payment_details',compact('paytrandata'));
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

    // get category list by ajax
    public function GetPaymentTranslist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'trans_id',
        3=> 'order_id',
        4=> 'customer',
        5=> 'amount',
        6=> 'payment_status',   
        7=> 'date',                    
        8=> 'action'
        );
            
        $totalDataRecord = PaymentTransaction::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $paytran_data = PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
        ->join('order', 'order.id', '=', 'payment_transactions.order_id')
        ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","order.order_id as order_id1")       
        ->offset($start_val)
        ->limit($limit_val)
        ->orderBy('payment_transactions.id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        // dd( $paytran_data);
        }
        else {
        $search_text = $request->input('search.value');

        $paytran_data =  PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
        ->join('order', 'order.id', '=', 'payment_transactions.order_id')
        ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","order.order_id as order_id1")
                            ->where(function ($query) use ($search_text) {
                                $query->where('payment_transactions.id', 'LIKE',"%{$search_text}%");
                                // ->orWhere('sub_categories.name', 'LIKE',"%{$search_text}%")
                                // ->orWhere('sub_categories.status', 'LIKE',"%{$search_text}%")
                                // ->orWhere('categories.name', 'LIKE',"%{$search_text}%");
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('payment_transactions.id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord =  $paytran_data->count();
        }
            
        $data_val = array();
        if(!empty($paytran_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($paytran_data as $value)
        {
            
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['trans_id'] = $value->transaction_id; 
            $nestedData['order_id'] = $value->order_id1;   
            $nestedData['customer'] = $value->firstname ." ". $value->lastname; 
            $nestedData['amount'] =  '$'.number_format($value->total_amount, 2);   
            $nestedData['payment_status'] = $value->payment_status;   
            $nestedData['date'] = date('Y-m-d', strtotime($value->created_at));  
                       
            
            $nestedData['action'] = '<button class="btn btn-dark p-2">
            <a href="'.route('view.payment.detail',[$value->id]) .'" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>';
            
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


    //payment  invoice
    public function Payment_Invoice($id)
    {
        $paymentdata = PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
        ->join('order', 'order.id', '=', 'payment_transactions.order_id')
        ->join('cards', 'cards.id', '=', 'order.card_id')
        ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","users.phone","users.email","users.address","order.order_id as order_id1","order.order_status","order.card_qty","cards.card_title")       
        ->where('payment_transactions.id',$id)
        ->get();

      

        // $path = public_path('images\logo.jpg');
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $data = file_get_contents($path);
        // $src ='data:image/' . $type . ';base64,' . base64_encode($data);

        $invoicenum = '#'.str_pad(23 + 1, 8, "0", STR_PAD_LEFT);
        $authdata =  Auth::user();

        $todaydate =  $todayDate = Carbon::now()->format('Y-m-d');
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'defaultFont' => 'sans-serif'])->loadView('Admin.payment_history.view_payment_invoice',compact('paymentdata','authdata','invoicenum'));
        $pdf->stream();
        return $pdf->download('invoice'.$paymentdata[0]->id.'-'.$todaydate.'.pdf');
    }
}
