<?php

// namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Session;

class UserController extends Controller
{
    // get show user list page
    public function UserList(){
    $data['userList'] = User::where('role','user')->orderby('id','DESC')->get();
    return view("Admin.adminuserpages.userlist")->with($data);
    }
    
    // get user list by ajax
    public function GetUsers(Request $request)
    {     
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'image',
        3=> 'name',
        4=> 'email',
        5=> 'mobile',              
        6=> 'status',
        7=> 'action'
        );
         
        $totalDataRecord = User::where('role','user')->count();
         
        $totalFilteredRecord = $totalDataRecord;
         
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
         
        if(empty($request->input('search.value')))
        {
        $user_data = User::where('role','user')->offset($start_val)
        ->limit($limit_val)
        // ->orderBy($order_val,$dir_val)      
        ->orderBy('id', 'ASC')
        ->get();
        }
        else {
        $search_text = $request->input('search.value');
 
        $user_data = User::select("id","fname", "lname","email","phone","status","image")
                            -> where('role','user')
						    ->where(function ($query) use ($search_text) {
							    $query->where('id', 'LIKE',"%{$search_text}%")
                                ->orWhere('email', 'LIKE',"%{$search_text}%")
                                ->orWhere('fname', 'LIKE',"%{$search_text}%")
                                ->orWhere('phone', 'LIKE',"%{$search_text}%")
                                ->orWhere('status', 'LIKE',"%{$search_text}%");
							})
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord =  $user_data->count();
                           
        }
         
        $data_val = array();
        if(!empty($user_data))
        {
         $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($user_data as $value)
        {
            $imagepath = url('public/upload/user').'/'.$value->image;
            $customimg = url('public/images/test.png');
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
             if($value->image == ""){
              $nestedData['image'] ='<img src="'.$customimg.'" height="50" width="50">';  
             }else{
            $nestedData['image'] ='<img src="'.$imagepath.'" height="50" width="50">';  
             }
            $nestedData['name'] = $value->fname. $value->lname  ;
            $nestedData['email'] = $value->email;
            $nestedData['mobile'] =  $value->phone;           
            if($value->status == "Active"){            
                $nestedData['status'] ='<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-success change-status'.$value->id.'"  onClick="UserStatusChange('.$value->id.')">'.$value->status.'</button></div>';
            }else{
                $nestedData['status'] = '<div class="changediv'.$value->id.' status-change"><button type="button" class="btn btn-danger change-status'.$value->id.'"  onClick="UserStatusChange('.$value->id.')">'.$value->status.'</button></div>';
            }
            
            $nestedData['action'] = '<button class="btn  p-2 btn-dark text-white">
            <a href="'.route('edit-customer',[$value->id]) .' " class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
            <button class="btn  p-2 btn-dark text-white" >
            <a href="'.route('delete-customer-post',[$value->id]) .'" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>';
            
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

    //show Add customer form
    public function AddCustomer()
    {
        return view("Admin.adminuserpages.create_customer");
    }

    // add customer
    public function AddCustomerPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "last_name" => "required",
            "user_mob" => "required||numeric|digits:10",
            "email" => "required|email|unique:users",
            "user_add" => "required",
            "user_status" => "required",
            "password" => "required|min:6",
            "confirmpassword" => "required|min:6|same:password",
            // "image" => "required",
        ]);

        if ($request->user_status == 1) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $imageName = time() . "." . $image->extension();
            $image->move(public_path("upload/user"), $imageName);
        }else{
            $imageName  = Null;
        }

        $user = new User();
        $user->fname = $request->name;
        $user->lname = $request->last_name;
        $user->phone = $request->user_mob;
        $user->email = $request->email;
        $user->status = $status;
        $user->address = $request->user_add;
        $user->password = Hash::make($request->password);
        $user->temp_password = $request->password;
        $user->image = $imageName;
        $user->role = "user";
        $res = $user->save();

        return redirect("admin/userlist")->with(
            "success",
            "Customer has been added successfully."
        );
    }

    // Edit customer data
    public function EditUser($id)
    {
        $users = User::find($id);
        return view("Admin.adminuserpages.edit_customer", compact("users"));
    }
 
     // update  customer data
     public function UpdateCustomer(Request $request, $id)
     {
         $request->validate([
             "name" => "required",
             "last_name" => "required",
             "user_mob" => "required||numeric|digits:10",
             "email" => "required|email|unique:users,email,".$id,
             "user_add" => "required",
             "user_status" => "required",
         ]);
 
         $userfind = User::find($id);
 
         if (empty($userfind)) {
             return back()->with("failed", "Data not found");
         } else {
             if ($request->user_status == 1) {
                 $status = "Active";
             } else {
                 $status = "Inactive";
             }
 
             if ($request->hasFile("image")) {
                 $image = $request->file("image");
                 $imageName = time() . "." . $image->extension();
                 $image->move(public_path("upload/user"), $imageName);
             } else {
                 $imageName = $userfind->image;
             }
 
             if($request->password == ""){
                 $password = $userfind->password;
             }else{
                 $password = Hash::make($request->password);
             }
 
             $userfind->fname = $request->name;
             $userfind->lname = $request->last_name;
             $userfind->phone = $request->user_mob;
             $userfind->email = $request->email;
             $userfind->status = $status;
             $userfind->address = $request->user_add;
             $userfind->image = $imageName;
             $userfind->role = "user";
 
             $userfind->save();
 
             return redirect("admin/userlist")->with(
                 "success",
                 "Customer has been updated successfully."
             );
         }
     }
 
 
    public function deleteCustomer(Request $request){
    
    $user_id = $request->id;
    // dd($user_id);
    $deleteUser = User::find($user_id);
    // if(empty($deleteUser)){
    //     return back()->with("failed", "Data not found");
    // }else{
    $res = $deleteUser->delete();
    if ($res) {
    return json_encode(array('status' => 'success','msg' => 'Customer has been deleted successfully.!'));
    }else {
    return json_encode(array('status' => 'error','msg' => 'Some internal issue occured.'));
    }
    }

    // active inactive status change
    public function User_status_change(Request $request)
	{
        $user_id = $request->user_id; 
        $newstatus = $request->status;

        User::where('id', $user_id)
        ->update(['status' => $newstatus
                 ]
                );
       return response()->json('Customer status changed successfully.');
	}
}
