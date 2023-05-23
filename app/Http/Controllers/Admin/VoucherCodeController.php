<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\VoucherCode;
use Illuminate\Http\Request;

class VoucherCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view("Admin.voucher_code.voucher_code_list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view("Admin.voucher_code.create_voucher_code");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
			"voucher_name" => "required",
            "voucher_code" => "required",
            "discount" => "required",
            "amount" => "required",
            "mamount" =>"required",
            "valid_till"  =>"required",
            "voucher_status" => "required"
		],
		[
			'mamount.required' => 'Minimum amount is required',
            'valid_till.required' => 'Expiry date is required',
		]);

        $storevouchercode = new VoucherCode();
        $storevouchercode->name = $request->voucher_name;
        $storevouchercode->voucher = $request->voucher_code;
        $storevouchercode->discount = $request->discount;
        $storevouchercode->amount = $request->amount;
        $storevouchercode->apply_min_amount = $request->mamount;
        $storevouchercode->valid_till = $request->valid_till;
        $storevouchercode->status = $request->voucher_status;
        $storevouchercode->uses_limit = $request->usage_limit;
        $storevouchercode->per_user = $request->per_user;

        $storevouchercode->save();

        return redirect("admin/voucher-code-list")->with(
            "success",
            "Voucher code added successfully !"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherCode  $voucherCode
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherCode $voucherCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherCode  $voucherCode
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherCode $voucherCode,$id)
    {
        $vouchercodedata =  VoucherCode::find($id);
        return view("Admin.voucher_code.edit_voucher_code",compact('vouchercodedata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoucherCode  $voucherCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
			"voucher_name" => "required",
            "voucher_code" => "required",
            "discount" => "required",
            "amount" => "required",
            "mamount" =>"required",
            "valid_till"  =>"required",
            "voucher_status" => "required"
		],
		[
			'mamount.required' => 'Minimum amount is required',
            'valid_till.required' => 'Expiry date is required',
		]);


        $voucheridfind = VoucherCode::find($id);
       
        $voucheridfind->name = $request->voucher_name;
        $voucheridfind->voucher = $request->voucher_code;
        $voucheridfind->discount = $request->discount;
        $voucheridfind->amount = $request->amount;
        $voucheridfind->apply_min_amount = $request->mamount;
        $voucheridfind->valid_till = $request->valid_till;
        $voucheridfind->status = $request->voucher_status;
        $voucheridfind->uses_limit = $request->usage_limit;
        $voucheridfind->per_user = $request->per_user;

        $voucheridfind->save();

        return redirect("admin/voucher-code-list")->with(
            "success",
            "Voucher code updated successfully !"
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherCode  $voucherCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $deletevouchercode = VoucherCode::find($id);
        $deletevouchercode->delete();
        return response()->json('success');
    }

    // get Voucher code list
    public function GetVoucherCodeList(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'name',
        3=> 'code',
        4=> 'discount',              
        5=> 'amount',
        6=> 'apply_on_amount',
        7=> 'valid_till',
        8=> 'status',
        9=> 'action'
        );
            
        $totalDataRecord = VoucherCode::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $voucher_data = VoucherCode::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        
        }
        else {
        $search_text = $request->input('search.value');

        $voucher_data = VoucherCode::select("id","name","voucher", "discount","amount","apply_min_amount","status","valid_till")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('name', 'LIKE',"%{$search_text}%")
                                ->orWhere('voucher', 'LIKE',"%{$search_text}%")
                                ->orWhere('discount', 'LIKE',"%{$search_text}%")
                                ->orWhere('apply_min_amount', 'LIKE',"%{$search_text}%")
                                ->orWhere('valid_till', 'LIKE',"%{$search_text}%")
                                ->orWhere('amount', 'LIKE',"%{$search_text}%");
                               
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = VoucherCode::select("id","name","voucher", "discount","amount","apply_min_amount","status","valid_till")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('name', 'LIKE',"%{$search_text}%")
                                ->orWhere('voucher', 'LIKE',"%{$search_text}%")
                                ->orWhere('discount', 'LIKE',"%{$search_text}%")
                                ->orWhere('apply_min_amount', 'LIKE',"%{$search_text}%")
                                ->orWhere('valid_till', 'LIKE',"%{$search_text}%")
                                ->orWhere('amount', 'LIKE',"%{$search_text}%");
                                        
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
        }
            
        $data_val = array();
        if(!empty($voucher_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($voucher_data as $value)
        {
            
            
            $nestedData['srno'] = $i;
            $nestedData['id'] = $value->id;
            $nestedData['name'] = $value->name;
            $nestedData['code'] = $value->voucher;  
            $nestedData['discount'] = ($value->discount == 0) ? 'Flat' :  '%' ; 
            $nestedData['amount'] = $value->amount;  
            $nestedData['apply_on_amount'] = $value->apply_min_amount; 
            $nestedData['valid_till'] = $value->valid_till;                   
            if($value->status == 1){
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-success change-status'.$value->id.'"  onClick="VoucherStatusChange('.$value->id.')">Active</button></div>';
            }else{
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-danger change-status'.$value->id.'"  onClick="VoucherStatusChange('.$value->id.')">Inactive</button></div>';
            }
            
            $nestedData['action'] = '<button class="btn btn-dark p-2">
            <a href="'.route('edit.voucher.code',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn btn-dark p-2">
            
            <a href="javascript:void(0);" onClick="delete_voucher_code('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-voucher'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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

    // active inactive status change
    public function VoucherStatusChange(Request $request)
	{
        $voucher_id = $request->mess_id; 
        $newstatus = $request->status;

        $newstatus = ($request->status == 'Active') ? '1' : '0' ;
        VoucherCode::where('id', $voucher_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Status changed successfully !');
	}
}
