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

class FrontCardController extends Controller{

	public function index(){

		$data['cards_data'] = DB::table('cards')->select('*')->where('status','Active')->get();
		
		
		return view("Front/cards")->with($data);
	}

	public function addFavourites(Request $request){
		if($request->favorite_id == 1){
			
			$favourite_cards = DB::table('favourite_cards')->where(['user_id'=>$request->user_id,'card_id'=>$request->card_id])->delete();
			session::flash('error', 'Card has been removed in the favourites');
			return redirect()->route('birthday-cards');
		}else{
			$user = Auth::user();
			if($user){
				$favourite_cards = DB::table('favourite_cards')->insert(['user_id'=>$request->user_id,'card_id'=>$request->card_id,'created_at'=>date('Y-m-d H:i:s')]);
				session::flash('success', 'Card has been added in the favourites');
				return redirect()->route('birthday-cards');
			}else{
				return redirect()->route('loginUser');
			}
			
		}
		
	}

	public function post_sizes(Request $request){
		$card_id = $request->card_id;
		$c_size = $request->c_size;
		
		$qty_box = $request->qty_box;
		$card_size_price = $request->card_size_price;

		$price_after_qty = $qty_box * $card_size_price;
		
		if(Auth::user()){
			$user_id = Auth::user()->id;
		}else{
			$user_id = 0;
		}

		$db_card_size = DB::table('card_sizes')->where('id',$c_size)->get()->first();
		
        $card_size_qty = $db_card_size->card_size_qty;
		$db_card_id = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$c_size)->get()->first();
		if(empty($db_card_id)){
			 $db_qty = 0;
		}else{
			 $db_qty = $db_card_id->qty;
		}
		
        $total_qty = $qty_box + $db_qty;
        
		
        if($card_size_qty >= $total_qty){
            
        	$favourite_cards = DB::table('cart_table')->insertGetId(['card_id'=>$card_id,'sizes'=>$c_size,'user_id'=>$user_id,'qty'=>$qty_box,'price'=>$price_after_qty,'status'=>'0','created_at'=>date('Y-m-d H:i:s')]);
				//echo $favourite_cards;die;
				Session::put('cart_id', $favourite_cards);
				return redirect('video_upload_page/'.$card_id.'/'.$c_size);
			
        }else{
        	
        	session::flash('error', 'Card quantity is not available');
        	return redirect()->route('birthday-cards');

        }
		
		//return redirect()->route('birthday-cards');
	}

	public function video_upload_page(Request $request){
		$card_id = $request->card_id;
		$data['db_card_data'] = DB::table('cards')->where('id',$card_id)->get()->first();
		$data['c_size_id'] = $request->card_size_id;
		$data['cart_id'] = Session::get('cart_id');
        
		return view('Front/video_page')->with($data);
	}

	public function post_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$cart_id = $request->cart_id;
		$qr_img_val = $request->qr_img_val;
		$file = $request->file('add_video_file');
		$movieFileType=$file->getClientOriginalName();
		$file_type = explode(".",$movieFileType);
        $file_type1 = end($file_type);
		if($file && $file_type1 == "mp4"){
	        $destinationPath = base_path() .'/public/upload/videos';
	        $file->move($destinationPath,$file->getClientOriginalName());

	        $data['video_data'] = DB::table('videos')->where('cart_id',$cart_id)->get()->first();

	        if($data['video_data']){
	        	$favourite_cards = DB::table('videos')->where('cart_id',$cart_id)->update(['video_name'=>$file->getClientOriginalName(),'qr_image_link'=>$qr_img_val, 'created_at'=>date('Y-m-d H:i:s')]);
	        }else{
	        	$video_id = DB::table('videos')->insertGetId(['video_name'=>$file->getClientOriginalName(),'cart_id'=>$cart_id, 'qr_image_link'=>$qr_img_val, 'created_at'=>date('Y-m-d H:i:s')]);
	        	
	        	$favourite_cards = DB::table('cart_table')->where('cart_id',$cart_id)->update(['video_id'=>$video_id, 'created_at'=>date('Y-m-d H:i:s')]);

	        }

	        session::flash('success', 'QR code is generated for this video');

	        return redirect('show_video/'.$card_id.'/'.$card_size_id);
    	}else{
    		session::flash('error', 'Please upload the video');
    		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
    	}
	}

	public function show_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$data['card_id'] = $card_id;
		$data['card_size_id'] = $card_size_id;
		$data['cart_id'] = Session::get('cart_id');
		$data['db_card_data'] = DB::table('videos')->where('cart_id',$data['cart_id'])->get()->first();
		return view('Front/show_video')->with($data);
	}

	public function delete_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$cart_id = $request->cart_id;

		$favourite_cards = DB::table('videos')->where('cart_id',$cart_id)->delete();

		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
	}

	public function card_editor(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$data['card_id'] = $card_id;
		$data['card_size_id'] = $card_size_id;
        
		$data['cart_id'] = Session::get('cart_id');
		//print_r($data['cart_id']->status);die;
		$data['db_card_data'] = DB::table('cards')->where('id',$request->card_id)->get()->first();
		$data['colors'] = DB::table('text_colors')->get();
		$data['fonts'] = DB::table('text_fonts')->get();
		// $data['db_text_data'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',1)->get()->first();
		// $data['db_text_data1'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',2)->get()->first();
		// $data['db_text_data2'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',3)->get()->first();

		return view('Front/card_editor')->with($data);
	}

	public function post_card(Request $request){
		$text_id = $request->text_id;
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$cart_id = $request->cart_id;
		
		$text_size_font1 = $request->text_size_font1;
		$text_color_font1 = $request->text_color_font1;
		$text_font1 = $request->text_font1;
	
		$text_size_font2 = $request->text_size_font2;
		$text_color_font2 = $request->text_color_font2;
		$text_font2 = $request->text_font2;
	
		$text_size_font3 = $request->text_size_font3;
		$text_color_font3 = $request->text_color_font3;
		$text_font3 = $request->text_font3;

		$data['db_text_data'] = DB::table('predesigned_text')->where('cart_id',$cart_id)->get()->first();
		//print_r($data['db_text_data']);die;
		
		if($text_font1 && $text_font2 && $text_font3){
			if(empty($data['db_text_data'])){
			
				$post_text1 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>1,'size'=>$text_size_font1,'color'=>$text_color_font1,'Text'=>$text_font1,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text2 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>2,'size'=>$text_size_font2,'color'=>$text_color_font2,'Text'=>$text_font2,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text3 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>3,'size'=>$text_size_font3,'color'=>$text_color_font3,'Text'=>$text_font3,'created_at'=>date('Y-m-d H:i:s')]);

				$post_text = $post_text1.",".$post_text2.",".$post_text3;

				$update_cart_status = DB::table('cart_table')->where('cart_id',$cart_id)->where('sizes',$card_size_id)->update(['status'=>1,'predesigned_text_id'=>$post_text,'created_at'=>date('Y-m-d H:i:s')]);
				
			}else{
				
				$post_text = DB::table('predesigned_text')->where('cart_id',$cart_id)->where('txt_id',1)->update(['size'=>$text_size_font1,'color'=>$text_color_font1,'Text'=>$text_font1,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text = DB::table('predesigned_text')->where('cart_id',$cart_id)->where('txt_id',2)->update(['size'=>$text_size_font2,'color'=>$text_color_font2,'Text'=>$text_font2,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text = DB::table('predesigned_text')->where('cart_id',$cart_id)->where('txt_id',3)->update(['size'=>$text_size_font3,'color'=>$text_color_font3,'Text'=>$text_font3,'created_at'=>date('Y-m-d H:i:s')]);
				
			}
			
			session::flash('success', 'The card has been added to the basket.');
	        return redirect('cart_continue');
		}else{
			session::flash('error', 'Please add all text');
			return redirect('card_editor/'.$card_id.'/'.$card_size_id);
		}
		

	}

	public function cart_continue(){
		return view("Front/cart_continue");
	}

	public function cart_page(){
		if(Auth::user()){
			echo $user_id = Auth::user()->id;
		}
		$data['cart_data'] = DB::table('cart_table')->where('user_id',$user_id)->where('status',1)->get();
		//print_r($data['cart_data']);die;
		return view("Front/cart")->with($data);
	}

	public function cart_table_show_data(Request $request){
		$cart_id = $request->cart_id;
        
        $uesr_id = Auth::user()->id;
		$cart_update = DB::table('cart_table')->where('cart_id',$cart_id)->update(['user_id'=>$uesr_id,'created_at'=>date('Y-m-d H:i:s')]);
		
	}

	public function cart_data(Request $request){
		$cart_id = $request->cart_id;
		$data['cart_data'] = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get();
		return view('Front/cart_data')->with($data);
		
	}

	public function post_cart(Request $request){
		$cart_id = $request->cart_id;
		
		$qty = $request->qty;

		$cart_update = DB::table('cart_table')->where('cart_id',$cart_id)->update(['qty'=>$qty,'created_at'=>date('Y-m-d H:i:s')]);

		
	}

	public function delete_cart_item(Request $request){
		echo $cart_id = $request->cart_id;

		$delete_cart_item = DB::table('cart_table')->where('cart_id',$cart_id)->delete();
        
		session::flash('success', 'Cart item remove successfully');

		//return redirect('cart');
	}

	public function checkout(Request $request){
		$user_id = Auth::user()->id;
		$data['cart_data'] = DB::table('cart_table')->where('user_id',$user_id)->where('status',1)->get();
		
		return view("Front/checkout")->with($data);
	}

	public function post_checkout(Request $request){
		$user_id = Auth::user()->id;
		$fname = $request->fname;
		$lname = $request->lname;
		$address = $request->address;
		$country = $request->country;
		$state = $request->state;
		$city = $request->city;
		$post_code = $request->post_code;
		$phone_no = $request->phone_no;
		$email_address = $request->email_address;
		$order_notes = $request->order_notes;
		$order_total_price = $request->order_total_price;
		
		$order_id = "ord-".mt_rand(1000,9999);

		$token = Str::random(64);
	    

		$post_checkout = DB::table('order')->insert(['order_id'=>$order_id,'customer_id'=>$user_id,'fname'=>$fname,'lname'=>$lname, 'phone_no'=>$phone_no, 'email'=>$email_address, 'country'=>$country, 'address'=>$address, 'city'=>$city, 'state'=>$state, 'postal_code'=>$post_code, 'order_notes'=>$order_notes, 'total'=>$order_total_price, 'sub_total'=>$order_total_price, 'order_status'=>'0', 'payment_method'=>'Cash of Delivery', 'pay_status'=>'Pending', 'created_at'=>date('Y-m-d H:i:s')]);

		

		if($post_checkout){	
			$cart_data = DB::table('cart_table')->where('user_id',$user_id)->where('status',1)->get();
			

            foreach($cart_data as $c_data){
            	$card_id = $c_data->card_id;
				$card_size_id = $c_data->sizes;
				$qty = $c_data->qty;
				$card_price = $c_data->price;
				$video_id = $c_data->video_id;
				$predesigned_text_id = $c_data->predesigned_text_id;
				$order_details = DB::table('order_details')->insert(['order_id'=>$order_id,'user_id'=>$user_id, 'card_id'=>$card_id, 'card_size_id'=>$card_size_id, 'video_id'=>$video_id, 'predesigned_text_id'=>$predesigned_text_id, 'qty'=>$qty, 'card_price'=>$card_price, 'created_at'=>date('Y-m-d H:i:s')]);
				
				$token = Str::random(64);
				
				// Mail::send('Front.order-invoice', ['token' => $token,'email'=>$email_address], function($message) use($request){
	   //              $message->to($request->email);
	   //              $message->from('votivephp.neha@gmail.com','BirthdayCards');
	   //              $message->subject('Order Invoice');
	   //          });

			
			}
			DB::table('cart_table')->where('user_id',$user_id)->where('status',1)->delete();
			return redirect('order_status/'.$order_id);
		}	
	}

	public function order_status(Request $request){
		$order_id = $request->order_id;
		
		return view("Front/order_status",['order_id'=>$order_id]);
	}
}