<?php


// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
use Session;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Mail; 


// use Redirect;

class AuthController extends Controller
{
    protected $guard = 'admin';   
    public function index(){
     return view('Admin/adminauthpages/login');
    }

    //admin login
    public function adminLogin(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $userdata = $request->only("email", "password");
        if (Auth::attempt($userdata)) {
        // if (Auth::guard("admin")->attempt($userdata)) {
            $user = Auth::user();
           if($user->role == 'admin'){
            Session::put("name", $user->fname);
            Session::put("proimg", $user->image);
            return redirect("admin/dashboard");
           }
        }
        return back()->with("failed", "You have entered invalid credentials");
    }

    // admin logout
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect("/admin");
    }

    //show change password
    public function ChangePassword()
    {
        return view("Admin.adminauthpages.manage_account");
    }

    //Change pasword 
    public function ChangePasswordSubmit(Request $request){
        $request->validate([
            "old_password" => "required|min:6",
            "new_password" => "required|min:6",
            "Cpassword"    => "required|min:6|same:new_password",
        ]);

        $auth = Auth::user();
        // dd(Hash::check($request->old_password,$auth->password));
        if(!Hash::check($request->old_password,$auth->password)){
            return back()->with('failed','Current Password is Invalid');
        }

        if(strcmp($request->old_password, $request->new_password) == 0){
            return back()->with('failed','New Password cannot be same as your current password.');
        }

        $user = User::find($auth->id);
        $user->password = hash::make($request->new_password);
        $user->save();

        return back()->with('success','Password Changed Successfully');
    }

    public function  forget_password(){
      return view("Admin.adminforgetppages.forgot-password");  
    }
     
    // send link reset passsword
    public function sendPasswordResetLink(Request $request){

        $this->validate($request,[
    		"email" => "required|email"
    	]);
      	$customer = User::where('email',$request->email)->first(); 
      	if (!$customer)  
          return back()->with('failed','Email address not found!.');

		$genrateToken=Str::random(60);

    

		DB::table('password_resets')->insert([
		  'email' => $request->email,
		  'token' => $genrateToken, 
		  'created_at' => Carbon::now()

		]);
   
		Mail::send('Admin.adminforgetppages.reset_password_link', ["fname" => $customer->name,"token" => $genrateToken],function ($message) use ($customer){
			$message->to($customer->email);
			$message->subject('Forgot password');
			$message->from(config("app.webmail"), config("app.mailname"));
		});
		return redirect()->back()->with("success" , "Reset password link has been sent to your email address.");
    }
      
  //reset password page
  public function ResetPasswordPage(Request $request)
	{ 
		try {
			$token=$request->token;
    
		} catch (Exception $e) {  
	    return view("Admin.adminforgetppages.reset_password",["invalid"=>"Reset password link has been expired or Invalid!"]);
		}
  
    $validateToken=DB::table("password_resets")->where("token",$token)->first();
    if (!$validateToken) {
      return view("Admin.adminforgetppages.reset_password")->with("invalid","Reset password link has been expired or Invalid!");
    }
    $currentTime = Carbon::now();
    if ($currentTime->diffInMinutes($validateToken->created_at) < 15) {
      // dd($token);
      return view("Admin.adminforgetppages.reset_password")->with('token', $token);
    } 
    else {
      return view("Admin.adminforgetppages.reset_password")->with("invalid","Reset password link has been expired or Invalid!");
    }    

  }

  
  public function updatePassword(Request $request){
   
    try {
      // $token1 = decrypt();
      $token1 =$request->token;
    
    } catch (Exception $e) {
      return redirect()->back()->with("invalid","Reset password link has been expired or Invalid!");
    }

    $this->validate($request, [
    'password' => 'required|min:6',  
    "cpassword" => "required|min:6|same:password",
    ]);

    $password=$request->password;
 
    $tokenData=DB::table("password_resets")->where("token",$token1)->first();
    
    
    if (is_null($tokenData)) {

    return redirect()->back()->with("invalid","Reset password link has been expired or Invalid!");

    }

    $user=User::where("email",$tokenData->email)->first();
    
    $user->password=Hash::make($password);

    if ($user->update()) {

      $tokenData=DB::table("password_resets")->where("email",$user->email)->delete();

    } 
   
    return redirect()->route("login")->with("success" ,"Password updated successfully!");

  }

    //show chage profile page
    public function ChangeProfile(){
      $authid = Auth::user();
      $getdata = User::where('role','admin')->where('id',$authid->id)->get();
  
     return view('Admin.adminauthpages.change_profile',compact('getdata'));
    }
  
    //show chage profile page
    public function ChangeProfileStore(Request $request){
      $this->validate($request, [
        'name' => 'required',  
        ]);
  
      if($request->hasFile("profile")) {
          $image = $request->file("profile");
          $imageName = time() . "." . $image->extension();
          $image->move(public_path("upload/user"), $imageName);
      }else{
        $imageName = $request->old_img;
      }
  
      $admindata = User::where('role','admin')->update([
        "fname" => $request->name,
        "image" => $imageName
      ]);
      $authid = Auth::user();
      session()->forget(['name', $authid->name]); //remove session [1,2,3] and store the new one
  
      session()->put('name', $request->name); //[2,3]
  
      session()->forget(['proimg', $authid->image]); //remove session [1,2,3] and store the new one
  
      session()->put('proimg', $imageName); //[2,3]
      
      if($admindata){
        return back()->with('success','Profile updated successfully !');
      }else{
        return back()->with('failed','Profile not updated!');
      }
  
     }

}
