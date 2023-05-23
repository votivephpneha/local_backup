<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['catList'] = Category::where('status',1)->orderby('id','DESC')->get();
      return view('Admin/admincategorypages/category_list')->with($data);
    }

     /**  
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
     return view('Admin/admincategorypages/create_category');
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
            "name" => "required",
            // "parent_id" => "required",           
        ]);

        $data = array(
          'name' => $request->name,
        );

        $res = Category::create($data);
        
        if($res){
        return redirect("admin/cardcategorylist")->with(
            "success",
            "Category has been added successfully."
        );
        }else{
        return back()->with("failed", "OOPs! Some internal issue occured.");  
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $category = Category::find($id);
        return view('Admin/admincategorypages/edit_category',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        // $category->category_id = $request->parent_id;
        $res = $category->save();
        
        if($res){
        return redirect("admin/cardcategorylist")->with(
            "success",
            "category has been updated successfully."
        );
       }else{
        return back()->with("failed", "OOPs! Some internal issue occured.");
       }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        $result = $category->delete();
        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Category has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }

    }

    // get category list by ajax
    public function getCategorylist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'category',
        // 3=> 'subcategory',                      
        3=> 'action'
        );
            
        $totalDataRecord = Category::where('status',1)->count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $categry_data = Category::where('status',1)->offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $categry_data = Category::select("id","category_id", "name","status")
                            ->where('status',1)
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('name', 'LIKE',"%{$search_text}%")
                                ->orWhere('status', 'LIKE',"%{$search_text}%");
        
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord =   $categry_data->count();
        }
            
        $data_val = array();
        if(!empty($categry_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($categry_data as $value)
        {
          
        
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['category'] = $value->name;  

            // if($value->category_id){
            //     $nestedData['subcategory'] ='<td>'.$value->parent->name.'</td>';
            // }else{
            //     $nestedData['subcategory'] = '<td>No parent category</td>';
            // }
            
            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.category',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn btn-dark p-2">
            <a href="'.route('subcategorylist',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_category('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-cat'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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
