<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Sub_category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('Admin/sub_category/sub_category_list'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/sub_category/create_sub_category'); 
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
			'name' => 'required',
		],
		[
			'name.required' => 'Sub category name is required',
		]);

        $sub_category = new Sub_category();
        $sub_category->name = $request->name;
        $sub_category->category_id = $request->cat_id;

        $sub_category->save();
        
        return redirect("admin/cardsubcategorylist/".$request->cat_id)->with(
            "success",
            "Sub category added successfully !"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_category $sub_category)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub_category $sub_category,$id)
    {
      $subcategory = Sub_category::find($id);
     return view('Admin/sub_category/edit_sub_category',compact('subcategory')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sub_category $sub_category,$id)
    {
        $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'Sub category name is required',
        ]);

        $subcategoryfind = Sub_category::find($id);
        $subcategoryfind->name = $request->name;
        $subcategoryfind->save();

        return redirect("admin/cardsubcategorylist/". $subcategoryfind->category_id)->with(
            "success",
            " Sub category updated successfully !"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $subcategory = Sub_category::find($id);
        $subcategory->delete();
        return response()->json('success');
    }


    // get category list
    public function getSubCategorylist(Request $request,$id)
    {
        $catid = $id ;
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'subcategory',
        3=> 'category',                      
        4=> 'action'
        );
            
        $totalDataRecord = Sub_category::where('status',1)->count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $subcategry_data = Sub_category::join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->select("sub_categories.id","categories.name as name1", "sub_categories.name","sub_categories.status")
        ->where('sub_categories.status',1)
        ->where('sub_categories.category_id','=',$catid)
        ->offset($start_val)
        ->limit($limit_val)
        ->orderBy('sub_categories.id', 'ASC')
        // ->groupBy('sub_categories.category_id')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $subcategry_data = Sub_category::join('categories', 'categories.id', '=', 'sub_categories.category_id')
                            ->select("sub_categories.id","categories.name as name1", "sub_categories.name","sub_categories.status")
                            ->where('sub_categories.status',1)
                            ->where('sub_categories.category_id','=',$catid)
                            ->where(function ($query) use ($search_text) {
                                $query->where('sub_categories.id', 'LIKE',"%{$search_text}%")
                                ->orWhere('sub_categories.name', 'LIKE',"%{$search_text}%")
                                ->orWhere('sub_categories.status', 'LIKE',"%{$search_text}%")
                                ->orWhere('categories.name', 'LIKE',"%{$search_text}%");
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('sub_categories.id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = Sub_category::join('categories', 'categories.id', '=', 'sub_categories.category_id')
                             ->select("sub_categories.id","categories.name as name1", "sub_categories.name","sub_categories.status")
                             ->where('sub_categories.status',1)
                             ->where('sub_categories.category_id','=',$catid)
                            ->where(function ($query) use ($search_text) {
                                $query->where('sub_categories.id', 'LIKE',"%{$search_text}%")
                                ->orWhere('sub_categories.name', 'LIKE',"%{$search_text}%")
                                ->orWhere('sub_categories.status', 'LIKE',"%{$search_text}%")
                                ->orWhere('categories.name', 'LIKE',"%{$search_text}%");
            
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy($order_val,$dir_val)
                            ->count();
        }
            
        $data_val = array();
        if(!empty($subcategry_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($subcategry_data as $value)
        {
          
        
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['subcategory'] = $value->name;  
            $nestedData['category'] = $value->name1;           
            
            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.sub.category',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_subcategory('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-subcat'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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
