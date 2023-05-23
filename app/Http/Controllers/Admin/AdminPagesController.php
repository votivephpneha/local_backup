<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageList'] = Page::orderby('id','DESC')->get();
       return view("Admin.admincpages.page_list")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.admincpages.create_page_form");
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
            
            "title" => "required",
            "page_content" => "required",
            "slug" => "required",
            "sub_title" => "required",
            "page_status" =>"required",
        ]);

        $page_slug = $request->slug;

		$page_url = Str::slug($page_slug, '-');
        $page = new Page();
        $page->page_url =  $page_url;
        $page->page_title = $request->title;
        $page->page_content = $request->page_content;
        $page->sub_title = $request->sub_title;
        $page->page_status = $request->page_status;

        $res = $page->save();
        
        if($res){
        return redirect("admin/content-pagelist")->with('success','Page content has been added Successfully.');
        }else{
        return back()->with("failed", "OOPs! Some internal issue occured.");   
        }
     
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
      $pagedata = Page::find($id);
  
      return view("Admin.admincpages.edit_page_content",compact('pagedata'));
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
        $request->validate([
            "title" => "required",
            "page_content" => "required",
            "slug" => "required",
            "sub_title" => "required",
            "page_status" =>"required",
        ]);

        $pagefind = Page::find($id);
        if (empty($pagefind)) {
            return back()->with("failed", "Data not found");
        }else{
            $page_slug = $request->slug;

            $page_url = Str::slug($page_slug, '-');
           
            $pagefind->page_url =  $page_url;
            $pagefind->page_title = $request->title;
            $pagefind->page_content = $request->page_content;
            $pagefind->sub_title = $request->sub_title;
            $pagefind->page_status = $request->page_status; 
            
            $res = $pagefind->save();
            
            if($res){
            return redirect("admin/content-pagelist")->with('success','Page content has been  updated successfully.');
            }else{
            return back()->with("failed", "OOPs! Some internal issue occured.");
            }
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $pages = Page::find($id);
        $result = $pages->delete();

        if ($result) {
            return json_encode(array('status' => 'success','msg' => 'Page has been deleted successfully!'));
         }else {
            return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
         }
    }

    //  get page list by ajax
    public function getPagelist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'title',
        3=> 'status',                      
        4=> 'action'
        );
            
        $totalDataRecord = Page::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $page_data = Page::offset($start_val)
        ->limit($limit_val)
        ->orderBy('id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        }
        else {
        $search_text = $request->input('search.value');

        $page_data = Page::select("id","page_title","page_status")
                            ->where(function ($query) use ($search_text) {
                                $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('page_title', 'LIKE',"%{$search_text}%")
                                ->orWhere('page_status', 'LIKE',"%{$search_text}%");       
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord = $page_data->count();
        }
            
        $data_val = array();
        if(!empty($page_data))
        {
            $i = $start_val+1;

        foreach ($page_data as $value)
        {
        
        
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['title'] = $value->page_title;

            if($value->page_status == 1){
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-success change-status'.$value->id.'"  onClick="ContentpageStatusChange('.$value->id.')">Active</button></div>';
            }else{
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-danger change-status'.$value->id.'"  onClick="ContentpageStatusChange('.$value->id.')">Inactive</button></div>';
            } 

            $nestedData['action'] = '<button class="btn btn-dark p-2" >
            <a href="'.route('edit.page',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn  btn-dark p-2" >
            <a href="javascript:void(0);" onClick="delete_page('.$value->id.')" data-id="'.$value->id.'" class="text-white delete-page'.$value->id.'" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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
    public function contentp_status_change(Request $request)
    {
        $page_id = $request->page_id; 
        $newstatus = $request->status;
        if($newstatus == 'Active'){
           $newstatus = 1 ;
        }else{
           $newstatus = 0 ;
        }
        Page::where('id', $page_id)
        ->update(['page_status' => $newstatus
                 ]
                );
       return response()->json('Page status changed successfully !');
    }
}
