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
            

				$favourite_cards = DB::table('cart_table')->insertGetId(['card_id'=>$card_id,'sizes'=>$c_size,'qty'=>$qty_box,'status'=>'0','created_at'=>date('Y-m-d H:i:s')]);
				echo $favourite_cards;die;
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

		return view('Front/video_page')->with($data);
	}

	public function post_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$qr_img_val = $request->qr_img_val;
		$file = $request->file('add_video_file');
		$movieFileType=$file->getClientOriginalName();
		$file_type = explode(".",$movieFileType);
        $file_type1 = end($file_type);
		if($file && $file_type1 == "mp4"){
	        $destinationPath = base_path() .'/public/upload/videos';
	        $file->move($destinationPath,$file->getClientOriginalName());

	        $favourite_cards = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->update(['video'=>$file->getClientOriginalName(),'qr_image_link'=>$qr_img_val, 'created_at'=>date('Y-m-d H:i:s')]);
	        return redirect('show_video/'.$card_id.'/'.$card_size_id);
    	}else{
    		session::flash('error', 'Please upload the video');
    		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
    	}
	}

	public function show_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$data['card_size_id'] = $card_size_id;
		$data['db_card_data'] = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->get()->first();
		return view('Front/show_video')->with($data);
	}

	public function delete_video(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$favourite_cards = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->update(['video'=>"",'qr_image_link'=>"", 'created_at'=>date('Y-m-d H:i:s')]);

		return redirect('video_upload_page/'.$card_id.'/'.$card_size_id);
	}

	public function card_editor(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;

		$data['cart_id'] = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->get()->first();
		//print_r($data['cart_id']->status);die;
		$data['db_card_data'] = DB::table('cards')->where('id',$request->card_id)->get()->first();
		$data['colors'] = DB::table('text_colors')->get();
		$data['fonts'] = DB::table('text_fonts')->get();
		$data['db_text_data'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',1)->get()->first();
		$data['db_text_data1'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',2)->get()->first();
		$data['db_text_data2'] = DB::table('predesigned_text')->where('cart_id',$data['cart_id']->cart_id)->where('txt_id',3)->get()->first();

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
			
				$post_text = DB::table('predesigned_text')->insert(['cart_id'=>$cart_id,'txt_id'=>1,'size'=>$text_size_font1,'color'=>$text_color_font1,'Text'=>$text_font1,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text = DB::table('predesigned_text')->insert(['cart_id'=>$cart_id,'txt_id'=>2,'size'=>$text_size_font2,'color'=>$text_color_font2,'Text'=>$text_font2,'created_at'=>date('Y-m-d H:i:s')]);
			
			
				$post_text = DB::table('predesigned_text')->insert(['cart_id'=>$cart_id,'txt_id'=>3,'size'=>$text_size_font3,'color'=>$text_color_font3,'Text'=>$text_font3,'created_at'=>date('Y-m-d H:i:s')]);

				$post_text = DB::table('cart_table')->where('cart_id',$cart_id)->where('sizes',$card_size_id)->update(['status'=>1,'created_at'=>date('Y-m-d H:i:s')]);
				
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
		$data['cart_data'] = DB::table('cart_table')->where('status',1)->get();
		//print_r($data['cart_data']);die;
		return view("Front/cart")->with($data);
	}

	public function cart_table_show_data(Request $request){
		$cart_id = $request->cart_id;
		$data['cart_data'] = DB::table('cart_table')->where('status',1)->where('cart_id',$cart_id)->get();
		
		//echo $data['cart_data'][0]->card_id;die;
		$data['card_data'] = DB::table('cards')->where('id',$data['cart_data'][0]->card_id)->get();

		$data['card_size_data'] = DB::table('card_sizes')->where('id',$data['cart_data'][0]->sizes)->where('card_id',$data['cart_data'][0]->card_id)->get();
		//print_r($data['card_size_data']);die;
		return $data;
	}

	public function post_cart(Request $request){
		$card_id = $request->card_id;
		$card_size_id = $request->card_size_id;
		$qty = $request->qty;

		$cart_update = DB::table('cart_table')->where('card_id',$card_id)->where('sizes',$card_size_id)->update(['qty'=>$qty,'created_at'=>date('Y-m-d H:i:s')]);

		
	}
}