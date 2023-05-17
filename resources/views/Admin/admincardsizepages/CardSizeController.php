<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CardSize;
use App\Models\Card;
use Illuminate\Http\Request;
use DB;

class CardSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return  view('Admin.admincardsizepages.card_size_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $carddata = Card::all();
     return  view('Admin.admincardsizepages.create_card_size',compact('carddata'));
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
            "card_type" => "required",
            "card_size" => "required", 
            "card"    =>   "required",
            "card_quantity" => "required"       
        ]);

        $data = array(
          'card_type' => $request->card_type,
          'card_size' => $request->card_size,
          'card_id' => $request->card,
          'card_size_qty' => $request->card_quantity
        );

        CardSize::create($data);
        
        return redirect("admin/card-size-list")->with(
            "success",
            "Card size added successfully"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardSize  $cardSize
     * @return \Illuminate\Http\Response
     */
    public function show(CardSize $cardSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CardSize  $cardSize
     * @return \Illuminate\Http\Response
     */
    public function edit(CardSize $cardSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CardSize  $cardSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardSize $cardSize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardSize  $cardSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $cardsize = CardSize::find($id);
        $cardsize->delete();
        return response()->json('success');
    }
    
    // get card size list
    public function getCardSizelist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'card_type',
        3=> 'card_size', 
        4=> 'card_title',  
        5=> 'card_quantity',                       
        6=> 'action'
        );
            
        $totalDataRecord = CardSize::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $cardsize_data = CardSize::with('card')->offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();       
        }
        else {
        $search_text = $request->input('search.value');

        $cardsize_data = CardSize::with('card')->select("id","card_type", "card_size","card_title","card_size_qty")                            
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('card_type', 'LIKE',"%{$search_text}%")
                                ->orWhere('card_size', 'LIKE',"%{$search_text}%");
        
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = CardSize::with('card')->select("id","card_type", "card_size","card_title","card_size_qty")
                             
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                        ->orWhere('card_type', 'LIKE',"%{$search_text}%")
                                        ->orWhere('card_size', 'LIKE',"%{$search_text}%");
            
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
        }
            
        $data_val = array();
        if(!empty($cardsize_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($cardsize_data);die;
        foreach ($cardsize_data as $value)
        {
         
        
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['card_type'] = $value->card_type;  
            $nestedData['card_size'] = $value->card_size;  
            $nestedData['card_title'] = $value->card['card_title']; 
            $nestedData['card_quantity'] = $value->card_size_qty;            
            $nestedData['action'] = '         
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_card_size('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-card-size'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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
}
