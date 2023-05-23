<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\FavouriteCards;
use Illuminate\Http\Request;
use DB;

class FavouriteCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['favList'] = DB::table('favourite_cards AS favcard')
                ->leftJoin('users AS u','u.id','=','favcard.user_id')
                ->leftJoin('cards AS card','card.id','=','favcard.card_id')
                ->select('favcard.*','u.*','card.*')
                ->orderby('favcard.favourite_card_id','DESC')
                ->get();
     return  view('Admin.favourite_cards.favourite_card_list')->with($data);  
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
        //
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
        $favourite_card_id = $request->id;       
         $favcard = FavouriteCards::where('favourite_card_id',$favourite_card_id)->delete();
        if ($favcard) {
            return json_encode(array('status' => 'success','msg' => 'Favourite card has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

    // get favourite card list
    public function getfavouritecardist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'card_title',
        3=> 'user_name',                      
        4=> 'action'
        );            
        $totalDataRecord = FavouriteCards::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
   
        $favcard_data  = DB::table('favourite_cards AS favcard')
                        ->leftJoin('users AS u','u.id','=','favcard.user_id')
                        ->leftJoin('cards AS card','card.id','=','favcard.card_id')
                        ->select('favcard.*','u.*','card.*')
                        ->offset($start_val)
                        ->limit($limit_val)
                        ->orderBy('favcard.favourite_card_id', 'ASC')
                        // ->orderBy($order_val,$dir_val)
                        ->get();   
        
      
        }
        else {
        $search_text = $request->input('search.value');

        $favcard_data = DB::table('favourite_cards AS favcard')
                        ->leftJoin('users AS u','u.id','=','favcard.user_id')
                        ->leftJoin('cards AS card','card.id','=','favcard.card_id')
                        ->select('favcard.*','u.fname','u.lname','card.card_title')
                        ->where(function ($query) use ($search_text) {
                            $query->where('favcard.favourite_card_id', 'LIKE',"%{$search_text}%")
                            ->orWhere('u.fname', 'LIKE',"%{$search_text}%")
                            ->orWhere('u.lname', 'LIKE',"%{$search_text}%")
                            ->orWhere('card.card_title', 'LIKE',"%{$search_text}%");
                            })
                        ->offset($start_val)
                        ->limit($limit_val)
                        ->orderBy('favcard.favourite_card_id', 'ASC')
                        // ->orderBy($order_val,$dir_val)
                        ->get();

        $totalFilteredRecord =  $favcard_data->count();
        }
            
        $data_val = array();
        if(!empty($favcard_data))
        {
            $i = $start_val+1;
      
        foreach ($favcard_data as $value)
        {
                
            $nestedData['id'] = $value->favourite_card_id;
            $nestedData['srno'] = $i;
            $nestedData['card_title'] = $value->card_title;  
            $nestedData['user_name'] = $value->fname." ".$value->lname ;  
            
            
            $nestedData['action'] = '         
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_favcard('.$value->favourite_card_id.')" data-id="'.$value->favourite_card_id.'" class="text-white delete-favcard'.$value->favourite_card_id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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
