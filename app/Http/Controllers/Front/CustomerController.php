<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use DB,Validator;
use Hash;
use Auth;
use Mail;

class CustomerController extends Controller{

	public function index(){
		return view("Front/register");
	}

	public function submitUser(Request $request){
		
        $user = User::where('email', '=', $request->email)->first();
        if($user){
        	session::flash('email_error', 'Email already exist.');
        	return redirect()->route('registration');
        }else{

			$users = DB::table('users')->insert(['fname'=>$request->fname,'lname'=>$request->lname,'email'=>$request->email,'password'=>Hash::make($request->password),'role'=>'user','status'=>'Active']);

			session::flash('success', 'User registered successfully.');
			return redirect()->route('registration');
        }
	}

	public function loginUser(){
		return view("Front/login");
	}

	public function submitloginUser(Request $request){
		$user_data = array(
	      'email'  => $request->get('email'),
	      'password' => $request->get('password')
	    );
        $user = User::where('email', '=', $request->email)->first();
        
		if(Auth::attempt($user_data) && $user->status == 'Active')
		{
			if($user_data['email']=="admin@gmail.com"){
				session::flash('error', 'Email or Password is Incorrect.');
				return redirect()->route('loginUser');
			}else{
				return redirect()->route('userProfile');
			}
			
		}
		else
		{
			session::flash('error', 'Email or Password is Incorrect.');
			return redirect()->route('loginUser');
		}
	}

	public function userProfile(){
		$user = array(
			'fname'=>Auth::User()->fname,
			'lname'=>Auth::User()->lname,
			'email'=>Auth::User()->email,
			'phone'=>Auth::User()->phone,
            'address'=>Auth::User()->address,
			'user_image'=>Auth::User()->image
		);
		
		if($user['fname'] == 'admin'){
			return redirect()->route('loginUser');
		}
		return view("Front/userProfile",['user_data'=>$user]);
	}

	public function postuserProfile(Request $request){
		$file = $request->file('profile_image');

		if($file){
			$extension  = $file->getClientOriginalName();
			$imgName = time().'_'.$extension;
	        $destinationPath = base_path() .'/public/upload/user';
	        $file->move($destinationPath,$imgName);
		}else{
			$imgName = $request->hidden_profile_image;
		}
		
        $user_id = Auth::User()->id;
		$user = User::find($user_id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone_no;
        $user->address = $request->address;
        $user->image = $imgName;
        $user->update();

        session::flash('success', 'Profile updated successfully.');

        return redirect()->route('userProfile');
	}

	public function user_ChangePassword()
    {
    	if(Auth::user()->fname == 'admin'){
			return redirect()->route('loginUser');
		}
    	return view('Front/changePassword');
    }

    public function postuser_ChangePassword(Request $request)
    {
    	$auth = Auth::user();
    	if (!Hash::check($request->get('old_password'), $auth->password)) 
        {
            session::flash('password_error', 'Current password is invalid');
            return redirect()->route('user_ChangePassword');
        }else{
        	$user_id = Auth::User()->id;
        	$user = User::find($user_id);
        	$user->password = Hash::make($request->new_password);
        	$user->save();
        	session::flash('password_success', 'Password updated successfully');
        	return redirect()->route('user_ChangePassword');
        }
    }

    public function user_order(){
    	if(Auth::user()->fname == 'admin'){
            return redirect()->route('loginUser');
        }
    	return view("Front/user_order");
    }

    public function user_favourites(){
    	if(Auth::user()->fname == 'admin'){
            return redirect()->route('loginUser');
        }
        $user_id = Auth::user()->id;
        $data['favourites_data'] = DB::table('favourite_cards')->where(['user_id' => $user_id]);

    	return view("Front/user_favourites")->with($data);
    }

    public function forget_password(){
    	return view("Front/forget_password");
    }

    public function postforget_password(Request $request){
        $email_data = DB::table('users')->where(['email' => $request->email])->first();
        
        if($email_data && $email_data->email != 'admin@gmail.com'){
            $token = Str::random(64);
            $password_reset_data = DB::table('password_resets')->where(['email' => $request->email])->first();
            if(!empty($password_reset_data)){
                DB::table('password_resets')->where('email',$request->email)->update([
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }else{
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
            
             Mail::send('Front.forget-password-email', ['token' => $token,'email'=>$request->email], function($message) use($request){
                $message->to($request->email);
                $message->from('info@votiveinfo.in','BirthdayCards');
                $message->subject('Reset Password');
            });

             session::flash('password_success', 'We have sent the link on email for reset password');
             return redirect()->route('forget_password');
         }else{
            session::flash('error', 'Email not found');
            return redirect()->route('forget_password');
         }
    	
    	
    }

    public function reset_password($token){

    	return view("Front/reset_password", ['token' => $token]);
    }

    public function postreset_password(Request $request)
    {
    	//echo $request->email;
    	//echo $request->token;
    	$update = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        //print_r($update);die;
        if(!$update){
            return back()->withInput()->with('error', 'Invalid token!');
        }else{
        	$user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->new_password)]);

	        DB::table('password_resets')->where(['email'=> $request->email])->delete();              
	    	return redirect('/loginUser')->with('message', 'Your password has been changed!');
        }
		
    	
        
    }

	public function front_logout()
    {
        Auth::logout();
        return Redirect("/loginUser");
    }
}