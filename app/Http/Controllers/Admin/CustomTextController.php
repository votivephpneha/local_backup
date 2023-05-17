<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TextFont;
use App\Models\TextSize;
use App\Models\TextColor;
use Illuminate\Http\Request;

class CustomTextController extends Controller
{
    // font start

    public function textfontlist()
    {
        return  view('Admin.text_font.text_font_list');
    }

    public function createtextfont()
    {
        return  view('Admin.text_font.create_text_font');
    }

    public function storetextfont(Request $request)
    {
        $request->validate([
			'font_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
		],
		[
			'font_name.required' => 'Font name is required',
			'font_name.regex' => 'Only alphabets are allowed',
		]);

        $textmess = new TextFont();
        $textmess->font_name = $request->font_name;
        $textmess->save();

        return redirect("admin/textfontlist")->with(
            "success",
            "font added successfully"
        );
    }

    public function edittextfont(TextFont $message,$id)
    {
        $messdata =  TextFont::find($id);
        return view('Admin.text_font.edit_text_font',compact('messdata'));
    }

    public function updatetextfont(Request $request, TextFont $message,$id)
    {
        $request->validate([
			'font_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
		],
		[
			'font_name.required' => 'Font name is required',
			'font_name.regex' => 'Only alphabets are allowed',
		]);

        $textmessfind = TextFont::find($id);
        if (empty($textmessfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->mess_status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            $textmessfind->font_name = $request->font_name ;
            $textmessfind->save();

            return redirect("admin/textfontlist")->with(
                "success",
                " Text message updated successfully"
            );
        }
    }

    public function destroytextfont(Request $request)
    {
        $textmesslist = TextFont::find($request->id);
         $textmesslist->delete();
         return response()->json('success');
    }


    // get font list

    public function getTextfontlist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'font_name',
        3=> 'action'
        );

        $totalDataRecord = TextFont::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
        $mess_data = TextFont::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $mess_data = TextFont::select("id","font_name")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('font_name', 'LIKE',"%{$search_text}%");

                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = TextFont::select("id","font_name", "status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                        ->orWhere('font_name', 'LIKE',"%{$search_text}%");

                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
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
            $nestedData['font_name'] = $value->font_name;

            if($value->status == "Active"){
                $nestedData['status'] ='<span class="label label-success">'.$value->status.'</span>';
            }else{
                $nestedData['status'] = '<span class="label label-danger">'.$value->status.'</span>';
            }

            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.textfont',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
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

    // font end

    // color start

    public function textcolorlist()
    {
        return  view('Admin.text_color.text_color_list');
    }

    public function createtextcolor()
    {
        return  view('Admin.text_color.create_text_color');
    }

    public function storetextcolor(Request $request)
    {
        $request->validate([
			'color_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
		],
		[
			'color_name.required' => 'Color name is required',
			'color_name.regex' => 'Only alphabets are allowed',
		]);

        if ($request->mess_status == 1) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        $textmess = new TextColor();
        $textmess->color_name = $request->color_name;
        $textmess->save();

        return redirect("admin/textcolorlist")->with(
            "success",
            "message added successfully"
        );
    }

    public function edittextcolor(TextColor $message,$id)
    {
        $messdata =  TextColor::find($id);
        return view('Admin.text_color.edit_text_color',compact('messdata'));
    }

    public function updatetextcolor(Request $request, TextColor $message,$id)
    {
        $request->validate([
			'color_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
		],
		[
			'color_name.required' => 'Color name is required',
			'color_name.regex' => 'Only alphabets are allowed',
		]);

        $textmessfind = TextColor::find($id);
        if (empty($textmessfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->mess_status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            $textmessfind->color_name = $request->color_name ;
            $textmessfind->save();

            return redirect("admin/textcolorlist")->with(
                "success",
                " Text message updated successfully"
            );
        }
    }

    public function destroytextcolor(Request $request)
    {
        $textmesslist = TextColor::find($request->id);
         $textmesslist->delete();
         return response()->json('success');
    }


    // get color list

    public function getTextcolorlist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'color_name',
        3=> 'action'
        );

        $totalDataRecord = TextColor::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
        $mess_data = TextColor::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $mess_data = TextColor::select("id","color_name", "status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('color_name', 'LIKE',"%{$search_text}%");

                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = TextColor::select("id","color_name", "status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                        ->orWhere('color_name', 'LIKE',"%{$search_text}%");

                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
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
            $nestedData['color_name'] = $value->color_name;

                if($value->status == "Active"){
                $nestedData['status'] ='<span class="label label-success">'.$value->status.'</span>';
            }else{
                $nestedData['status'] = '<span class="label label-danger">'.$value->status.'</span>';
            }

            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.textcolor',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
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

    // color end

    // size start

    public function textsizelist()
    {
        return  view('Admin.text_size.text_size_list');
    }

    public function createtextsize()
    {
        return  view('Admin.text_size.create_text_size');
    }

    public function storetextsize(Request $request)
    {
        $request->validate([
            "text_size" => "required|numeric",
        ]);

        if ($request->mess_status == 1) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        $textmess = new TextSize();
        $textmess->text_size = $request->text_size;
        $textmess->save();

        return redirect("admin/textsizelist")->with(
            "success",
            "message added successfully"
        );
    }

    public function edittextsize(TextSize $message,$id)
    {
        $messdata =  TextSize::find($id);
        return view('Admin.text_size.edit_text_size',compact('messdata'));
    }

    public function updatetextsize(Request $request, TextSize $message,$id)
    {
        $request->validate([
            "text_size" => "required",
        ]);

        $textmessfind = TextSize::find($id);
        if (empty($textmessfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->mess_status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            $textmessfind->text_size = $request->text_size ;
            $textmessfind->save();

            return redirect("admin/textsizelist")->with(
                "success",
                " Text message updated successfully"
            );
        }
    }

    public function destroytextsize(Request $request)
    {
        $textmesslist = TextSize::find($request->id);
         $textmesslist->delete();
         return response()->json('success');
    }



    // get size list

    public function getTextsizelist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'text_size',
        3=> 'action'
        );

        $totalDataRecord = TextSize::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
        $mess_data = TextSize::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $mess_data = TextSize::select("id","text_size", "status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('text_size', 'LIKE',"%{$search_text}%");

                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = TextSize::select("id","text_size", "status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                        ->orWhere('text_size', 'LIKE',"%{$search_text}%");

                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
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
            $nestedData['text_size'] = $value->text_size;

                if($value->status == "Active"){
                $nestedData['status'] ='<span class="label label-success">'.$value->status.'</span>';
            }else{
                $nestedData['status'] = '<span class="label label-danger">'.$value->status.'</span>';
            }

            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.textsize',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
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

    // size end


}
