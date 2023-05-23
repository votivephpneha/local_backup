<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Card;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['messlist'] = Message::orderby('id','DESC')->get();
      return  view('Admin.admintmessagepages.textmessage_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $carddata = Card::all();
        return  view('Admin.admintmessagepages.create_textmessage',compact('carddata'));
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
            "text_mess" => "required",
            "mess_status" => "required", 
            // "card"       => "required"          
        ]);
        $card_id = null ;

        if($request->card){
          $card_id = $request->card; 
        }
        

        if ($request->mess_status == 1) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        $textmess = new Message();
        $textmess->text_message = $request->text_mess;      
        $textmess->status = $status;
        $textmess->card_id =  $card_id ;
        $res = $textmess->save();

        if($res){
        return redirect("admin/textmessagelist")->with(
            "success",
            "Text message has been added successfully."
        );
        }else{
        return back()->with("failed", "OOPs! Some internal issue occured."); 
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message,$id)
    {
        $messdata =  Message::find($id);
        $carddata = Card::all();
        return view('Admin.admintmessagepages.edit_textmessage',compact('messdata','carddata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message,$id)
    {
        $request->validate([
            "text_mess" => "required",
            "mess_status" => "required",
        ]);
        
        $card_id = null ;

        if($request->card){
          $card_id = $request->card; 
        } 
        
        $textmessfind = Message::find($id);
        if (empty($textmessfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->mess_status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }
           
            $textmessfind->text_message = $request->text_mess ;
            $textmessfind->status = $status;
            $textmessfind->card_id = $card_id;
            $res = $textmessfind->save();

            if($res){
            return redirect("admin/textmessagelist")->with(
                "success",
                " Text message has been updated successfully."
            );
            }else{
            return back()->with("failed", "OOPs! Some internal issue occured."); 
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $textmesslist = Message::find($request->id);
         $result = $textmesslist->delete();
         if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Text message has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

    // get message list by ajax
    public function getTextmessagelist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'textmessage',              
        3=> 'status',
        4=> 'action'
        );
            
        $totalDataRecord = Message::count();
                    
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $mess_data = Message::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $mess_data = Message::select("id","text_message", "status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('text_message', 'LIKE',"%{$search_text}%")
                                ->orWhere('status', 'LIKE',"%{$search_text}%");
        
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = $mess_data->count();
        }
            
        $data_val = array();
        if(!empty($mess_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($mess_data as $value)
        {
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['textmessage'] = $value->text_message;  
                   
            if($value->status == "Active"){
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-success change-status'.$value->id.'"  onClick="MessStatusChange('.$value->id.')">'.$value->status.'</button></div>';
            }else{
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-danger change-status'.$value->id.'"  onClick="MessStatusChange('.$value->id.')">'.$value->status.'</button></div>';
            }
            
            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.message',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_message('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-text-mess'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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
    public function Mess_status_change(Request $request)
	{
        $mess_id = $request->mess_id; 
        $newstatus = $request->status;
        Message::where('id', $mess_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Text message status changed successfully.');
	}
}
