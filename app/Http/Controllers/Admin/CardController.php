<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Card_gallery_image;
use App\Models\Category;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('Admin.admincardpages.card_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    $category = Category::all();
    $subcategory = Sub_category::all();
    return view('Admin.admincardpages.create_card',compact('category','subcategory'));
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
            "price" => "required",
            "title" => "required",
            "description" => "required",
            "card_image" => "required",
            "card_status" => "required",
            "gall_image" =>"required",
            "qty" => "required",
            "category_id" => "required",
            "subcategory_id" => "required"
        ]);

        if ($request->card_status == 1) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        if ($request->hasFile("card_image")) {
            $image = $request->file("card_image");
            $imageName = time() . "." . $image->extension();
            $image->move(public_path("upload/cards"), $imageName);
        }

        $card = new Card();
        $card->price = $request->price;
        $card->card_title = $request->title;
        $card->description = $request->description;
        $card->status = $status;
        $card->qty = $request->qty;
        $card->card_image = $imageName;
        $card->category_id = $request->category_id;
        $card->sub_category_id = $request->subcategory_id;
        $card->save();

        $files = $request->file('gall_image');

        foreach ($files as $file) {

            $name = Str::random(6) . time() . '.' . $file->getClientOriginalExtension();
            // dd($name);

            $image = $file;

            $image->move(public_path("upload/gallery_images"), $name);


            Card_gallery_image::create([

                'gall_images' => $name,

                'card_id' => $card->id,

            ]);
        }

        return redirect("admin/cardlist")->with(
            "success",
            "Card added successfully"
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card,$id)
    {
        $viewdata =  Card::find($id);
        
        return view('Admin.admincardpages.view_card',compact('viewdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card,$id)
    {
        $carddata =  Card::find($id);
        $categorydata = Category::all();
        $subcategory = Sub_category::all();
        return view('Admin.admincardpages.edit_card',compact('carddata','categorydata','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card,$id)
    {
        $request->validate([
            "price" => "required",
            "description" => "required",
            "card_status" => "required",
            "title" => "required",
            "qty" => "required",
            "category_id" => "required",
            "subcategory_id" => "required"
        ]);

        $cardfind = Card::find($id);
        if (empty($cardfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->card_status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            if ($request->hasFile("card_image")) {
                $image = $request->file("card_image");
                $imageName = time() . "." . $image->extension();
                $image->move(public_path("/upload/cards"), $imageName);
            } else {
                $imageName = $cardfind->card_image;
            }
          
            $cardfind->price = $request->price ;
            $cardfind->card_title = $request->title ;
            $cardfind->description = $request->description;
            $cardfind->status = $status;
            $cardfind->card_image = $imageName;
            $cardfind->qty = $request->qty;
            $cardfind->category_id = $request->category_id;
            $cardfind->sub_category_id = $request->subcategory_id; 

            $cardfind->save();

            if ($request->hasFile("card_gall_image")) {

				$files = $request->file('card_gall_image');

				foreach ($files as $file) {

					$name = Str::random(6) . time() . '.' . $file->getClientOriginalExtension();

					$image = $file;

                    $image->move(public_path("upload/gallery_images"), $name);

					Card_gallery_image::create([

						'gall_images' => $name,

                        'card_id' => $cardfind->id,

					]);
				}
            }

            return redirect("admin/cardlist")->with(
                "success",
                "Card information updated successfully"
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $list = Card::find($request->id);
       
       $image_name =  $list->card_image;
       $image_path = public_path('upload/cards/'.$image_name);
       if(File::exists($image_path)) {
         File::delete($image_path);
       }

        $list->delete();
        return response()->json('success');
    }
    // get card list
    public function getCardlist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'title',
        3=> 'image',
        4=> 'price',              
        5=> 'status',
        6=> 'action'
        );
            
        $totalDataRecord = Card::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $card_data = Card::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $card_data = Card::select("id","card_title","price", "status","card_image")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('price', 'LIKE',"%{$search_text}%")
                                ->orWhere('status', 'LIKE',"%{$search_text}%")
                                ->orWhere('card_title', 'LIKE',"%{$search_text}%")
                                ->orWhere('card_image', 'LIKE',"%{$search_text}%");
                               
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = Card::select("id","card_title","price", "status","card_image")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                        ->orWhere('price', 'LIKE',"%{$search_text}%")
                                        ->orWhere('status', 'LIKE',"%{$search_text}%")
                                        ->orWhere('card_title', 'LIKE',"%{$search_text}%")
                                        ->orWhere('card_image', 'LIKE',"%{$search_text}%");
                                        
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
        }
            
        $data_val = array();
        if(!empty($card_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($card_data as $value)
        {
            $imagepath = url('public/upload/cards').'/'.$value->card_image;
            $newprice =  number_format((float)$value->price, 2, '.', '');
            
            $nestedData['srno'] = $i;
            $nestedData['id'] = $value->id;
            $nestedData['title'] = $value->card_title;
            $nestedData['image'] ='<img src="'.$imagepath.'" height="50" width="50">';  
            $nestedData['price'] = '$'.$newprice ;
                   
                if($value->status == "Active"){
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><span class="label label-success change-status'.$value->id.'"  onClick="StatusChange('.$value->id.')">'.$value->status.'</span></div>';
            }else{
                $nestedData['status'] = '<div class="changediv'.$value->id.' status-change"><span class="label label-danger change-status'.$value->id.'"  onClick="StatusChange('.$value->id.')">'.$value->status.'</span></div>';
            }
            
            $nestedData['action'] = '<button class="btn btn-dark p-2">
            <a href="'.route('edit.card',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn btn-dark p-2">
            <a href="'.route('view.card',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="check('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-card'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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


    public function card_gallery_delete($gl_id)
	{
        Card_gallery_image::where('id', '=', $gl_id)->delete();

        return back()->with("success", "Image deleted successfully");
	}

    public function Status_change(Request $request)
	{
        $card_id = $request->status_id; 
        $newstatus = $request->status;

        Card::where('id', $card_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Status changed successfully !');
	}
}
