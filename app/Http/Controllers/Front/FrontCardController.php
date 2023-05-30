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
			$user = Auth::guard("customer")->user();
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
		$data['messages'] = DB::table('messages')->get();
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
		$text_align_hor_font1 = $request->text_align_hor_font1;
		$text_align_ver_font1 = $request->text_align_ver_font1;
		$text_font_font1 = $request->text_font_font1;
	
		$text_size_font2 = $request->text_size_font2;
		$text_color_font2 = $request->text_color_font2;
		$text_font2 = $request->text_font2;
		$text_align_hor_font2 = $request->text_align_hor_font2;
		$text_align_ver_font2 = $request->text_align_ver_font2;
		$text_font_font2 = $request->text_font_font2;
	
		$text_size_font3 = $request->text_size_font3;
		$text_color_font3 = $request->text_color_font3;
		$text_font3 = $request->text_font3;
		$text_align_hor_font3 = $request->text_align_hor_font3;
		$text_align_ver_font3 = $request->text_align_ver_font3;
		$text_font_font3 = $request->text_font_font3;

		$data['db_text_data'] = DB::table('predesigned_text')->where('cart_id',$cart_id)->get()->first();
		//print_r($data['db_text_data']);die;
		
		if($text_font1 && $text_font2 && $text_font3){
			if(empty($data['db_text_data'])){
			
				$post_text1 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>1,'size'=>$text_size_font1,'color'=>$text_color_font1,'Text'=>$text_font1,'font'=>$text_font_font1,'horizontal_alignment'=>$text_align_hor_font1,'vertical_alignment'=>$text_align_ver_font1,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text2 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>2,'size'=>$text_size_font2,'color'=>$text_color_font2,'Text'=>$text_font2,'font'=>$text_font_font2,'horizontal_alignment'=>$text_align_hor_font2,'vertical_alignment'=>$text_align_ver_font2,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text3 = DB::table('predesigned_text')->insertGetId(['cart_id'=>$cart_id,'txt_id'=>3,'size'=>$text_size_font3,'color'=>$text_color_font3,'Text'=>$text_font3,'font'=>$text_font_font3,'horizontal_alignment'=>$text_align_hor_font3,'vertical_alignment'=>$text_align_ver_font3,'created_at'=>date('Y-m-d H:i:s')]);

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
			$user_id = Auth::user()->id;
		}
		$data['cart_data'] = DB::table('cart_table')->where('user_id',$user_id)->where('status',1)->get();
		//print_r($data['cart_data']);die;
		Session::put("cart", "cart");
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

		$card_id = $data['cart_data'][0]->card_id;
		$card_sizes = $data['cart_data'][0]->sizes;

		$data['card_size_data'] = DB::table('card_sizes')->where('id',$card_sizes)->where('card_id',$card_id)->get()->first();

		$card_qty =  $data['card_size_data']->card_size_qty;

		$remaining_qty = $card_qty - $data['cart_data'][0]->qty;
		$data['remaining_qty'] = $remaining_qty;

		
		return view('Front/cart_data')->with($data);
		
	}

	public function post_cart(Request $request){
		$cart_id = $request->cart_id;
		
		$qty = $request->qty;
		$price = $request->price;

		$cart_update = DB::table('cart_table')->where('cart_id',$cart_id)->update(['qty'=>$qty,'price'=>$price,'created_at'=>date('Y-m-d H:i:s')]);

		
	}

	public function get_cards(Request $request){

		$data['search_data'] = DB::table('cards')->where("card_title", 'like', '%'.$request->search_words.'%')->get();
		//print_r($data['search_data']);die;
		if(count($data['search_data'])>0){
			foreach ($data['search_data'] as $search_data) {
				$data1['search_data'] = $search_data;
				echo view("Front/search_data")->with($data1);
			}
		}else{
			echo "No card found";
		}
	}

	public function searchModel(Request $request){
		$card_id = $request->card_id;
		echo view('Front/search_modal',["card_id"=>$card_id]);
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
		$data['countries'] = DB::table('countries')->get();
		
		return view("Front/checkout")->with($data);
	}

	public function get_state(Request $request){
		$country_id = $request->country_id;
		$data['states'] = DB::table('states')->where('country_id',$country_id)->get();

		foreach ($data['states'] as $states) {
			echo "<option value=".$states->id.">".$states->name."</option>";
		}
		
	}

	public function get_city(Request $request){
		$state_id = $request->state_id;
		$data['cities'] = DB::table('cities')->where('state_id',$state_id)->get();

		foreach ($data['cities'] as $cities) {
			echo "<option value=".$cities->id.">".$cities->name."</option>";
		}
		
	}

	public function post_checkout(Request $request){
		$cart_id_array = $request->cart_id_array;
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

		$cart_id_arr = json_decode($cart_id_array);
		
		$post_checkout = DB::table('order')->insert(['order_id'=>$order_id,'customer_id'=>$user_id,'fname'=>$fname,'lname'=>$lname, 'phone_no'=>$phone_no, 'email'=>$email_address, 'country'=>$country, 'address'=>$address, 'city'=>$city, 'state'=>$state, 'postal_code'=>$post_code, 'order_notes'=>$order_notes, 'total'=>$order_total_price, 'sub_total'=>$order_total_price, 'order_status'=>'0', 'payment_method'=>'Cash of Delivery', 'pay_status'=>'Pending', 'created_at'=>date('Y-m-d H:i:s')]);
        

		if($post_checkout){	
			$cart_data = DB::table('cart_table')->where('user_id',$user_id)->where('status',1)->get();
			

            foreach ($cart_id_arr as $cart_id) {
				$cart_data = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get()->first();
				$card_id = $cart_data->card_id;
				$card_size_id = $cart_data->sizes;
				$qty = $cart_data->qty;
				$card_price = $cart_data->price;
				$video_id = $cart_data->video_id;
				$predesigned_text_id = $cart_data->predesigned_text_id;
				$order_details = DB::table('order_details')->insert(['order_id'=>$order_id,'user_id'=>$user_id, 'card_id'=>$card_id, 'card_size_id'=>$card_size_id, 'video_id'=>$video_id, 'predesigned_text_id'=>$predesigned_text_id, 'qty'=>$qty, 'card_price'=>$card_price, 'created_at'=>date('Y-m-d H:i:s')]);

				$card_qty_data = DB::table('card_sizes')->where('id',$card_size_id)->where('card_id',$card_id)->get()->first();

				$remaining_qty = $card_qty_data->card_size_qty - $qty;

				$card_qty_update = DB::table('card_sizes')->where('id',$card_size_id)->where('card_id',$card_id)->update(['card_size_qty'=>$remaining_qty,'created_at'=>date('Y-m-d H:i:s')]);
				
				DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->delete();
				
			}
			$token = Str::random(64);
			        
			Mail::send('Front.order-invoice', ['token' => $token,'email'=>$email_address,'order_id'=>$order_id], function($message) use($request){
		                $message->to($request->email_address);
		                $message->from('votivephp.neha@gmail.com','BirthdayCards');
		                $message->subject('Order Invoice');

			});

			
			return redirect('order_status/'.$order_id);
			//return view("Front/order-invoice",['order_id'=>$order_id]);

		}	
	}

	public function order_status(Request $request){
		$order_id = $request->order_id;
		
		return view("Front/order_status",['order_id'=>$order_id]);
	}

	public function checkout_data(Request $request){

		$cart_id = $request->cart_id;
		$data['cart_data'] = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get();

		
		return view('Front/checkout_data')->with($data);
	}

	public function search_submit(Request $request){
		$data['search_data'] = DB::table('cards')->where("card_title", 'like', '%'.$request->search_words.'%')->get();
		//print_r($data['search_data']);die;
		$data['request_data'] = $request->search_words;
		
		if(count($data['search_data']) <= 0){
			$data['no_data_found'] = "No Result Found";
		}
		return view('Front/search')->with($data);
		
		
	}

	public function contact_us(){
		return view('Front/contact');
	}


	public function submitContact(Request $request){
		$token = Str::random(64);
		
		Mail::send('Front.contact-us-email', ['token' => $token,'email'=>$request->email,'phone_no'=>$request->phone_no,'message'=>$request->message], function($message) use($request){
            $message->to("votivephp.neha@gmail.com");
            $message->from($request->email,'BirthdayCards');
            $message->subject($request->subject);
        });

        session::flash('success', 'Thanks for contacting us. We will get back to you as soon as possible.');
	}
	
}