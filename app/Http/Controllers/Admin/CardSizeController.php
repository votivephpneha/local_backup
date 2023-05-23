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
      $data['cardsizeList'] = DB::table('card_sizes')
                            ->leftJoin('cards AS card','card.id','=','card_sizes.card_id')
                            ->select('card_sizes.*','card.card_title') 
                            ->orderby('card.id','DESC')
                            ->get();

      return  view('Admin.admincardsizepages.card_size_list')->with($data);
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
            "card_price" => "required",
            "card_quantity" => "required"       
        ]);

        $data = array(
          'card_type' => $request->card_type,
          'card_size' => $request->card_size,
          'card_id' => $request->card,
          'card_price' => $request->card_price,
          'card_size_qty' => $request->card_quantity
        );

        $res = CardSize::create($data);
        
        if($res){
        return redirect("admin/card-size-list")->with(
            "success",
            "Card size has been added successfully."
        );
        }else{
       return back()->with("failed", "OOPs! Some internal issue occured."); 
        }
        
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
    public function edit(CardSize $cardSize,$id)
    {
      $carddata = Card::all();
      $findcardsize = CardSize::find($id);
      return  view('Admin.admincardsizepages.edit_card_size',compact('carddata','findcardsize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CardSize  $cardSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "card_type" => "required",
            "card_size" => "required", 
            "card"    =>   "required",
            "card_price" => "required",
            "card_quantity" => "required"  
        ]);
         
        
        $cardsizefind = CardSize::find($id);
        

        if (empty($cardsizefind)) {
            return back()->with("failed", "Data not found");
        } else {
                      
            $cardsizefind->card_type = $request->card_type;
            $cardsizefind->card_size= $request->card_size;
            $cardsizefind->card_id = $request->card;
            $cardsizefind->card_price = $request->card_price;
            $cardsizefind->card_size_qty = $request->card_quantity;
            $res = $cardsizefind->save();

            if($res){
            return redirect("admin/card-size-list")->with(
                "success",
                "Card size has been  updated successfully."
            );
            }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");   
            }            
        }
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
        $result = $cardsize->delete();

        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Card size has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
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
        6=> 'card_price',                       
        7=> 'action'
        );
            
        $totalDataRecord = CardSize::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $cardsize_data = DB::table('card_sizes')
        ->leftJoin('cards AS card','card.id','=','card_sizes.card_id')
        ->select('card_sizes.*','card.card_title')
        ->offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();       
        }
        else {
        $search_text = $request->input('search.value');
        
        $cardsize_data = DB::table('card_sizes')
                        ->leftJoin('cards AS card','card.id','=','card_sizes.card_id')
                        ->select('card_sizes.*','card.card_title')
                        ->where(function ($query) use ($search_text) {
                            $query->where('card_sizes.id', 'LIKE',"%{$search_text}%")
                            ->orWhere('card_sizes.card_type', 'LIKE',"%{$search_text}%")
                            ->orWhere('card_sizes.card_size', 'LIKE',"%{$search_text}%")
                            ->orWhere('card_sizes.card_size_qty', 'LIKE',"%{$search_text}%")
                            ->orWhere('card_sizes.card_price', 'LIKE',"%{$search_text}%")
                            ->orWhere('card.card_title', 'LIKE',"%{$search_text}%");
                            })
                        ->offset($start_val)
                        ->limit($limit_val)
                        ->orderBy('card_sizes.id', 'ASC')
                        // ->orderBy($order_val,$dir_val)
                        ->get();

        $totalFilteredRecord =  $cardsize_data->count();
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
            $nestedData['card_title'] = $value->card_title; 
            $nestedData['card_price'] = '$'.number_format($value->card_price, 2);
            $nestedData['card_quantity'] = $value->card_size_qty;            
            $nestedData['action'] = '<button class="btn btn-dark p-2">
            <a href="'.route('edit.card.size',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>         
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
