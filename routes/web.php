<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CardSizeController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\CustomTextController;
use App\Http\Controllers\Front\FrontCardController;
use App\Http\Controllers\Admin\FavouriteCardsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VoucherCodeController;
use App\Http\Controllers\Admin\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/config-cache', function () {
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('route:clear');
	$exitCode = Artisan::call('view:clear');
	return '<h1>config cache cleared</h1>';
});

Route::get('/cache', function () {
	Artisan::call('config:cache');
	Artisan::call('config:clear');
	Artisan::call('route:clear');
});

//Front Module
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/birthday-cards', [FrontCardController::class, 'index'])->name('birthday-cards');
Route::post('/birthday-favourites', [FrontCardController::class, 'addFavourites'])->name('addFavourites');
Route::post('/post_sizes', [FrontCardController::class, 'post_sizes'])->name('post_sizes');
Route::get('/video_upload_page/{card_id}/{card_size_id}', [FrontCardController::class, 'video_upload_page'])->name('video_upload_page');
Route::post('/post_video', [FrontCardController::class, 'post_video'])->name('post_video');
Route::get('/show_video/{card_id}/{card_size_id}', [FrontCardController::class, 'show_video'])->name('show_video');
Route::post('/delete_video', [FrontCardController::class, 'delete_video'])->name('delete_video');
Route::get('/card_editor/{card_id}/{card_size_id}', [FrontCardController::class, 'card_editor'])->name('card_editor');
Route::post('/post_card', [FrontCardController::class, 'post_card'])->name('post_card');
Route::get('/cart_continue', [FrontCardController::class, 'cart_continue'])->name('cart_continue');
Route::get('/cart', [FrontCardController::class, 'cart_page'])->name('cart_page');
Route::post('/post_cart', [FrontCardController::class, 'post_cart'])->name('post_cart');
Route::get('/cart_table', [FrontCardController::class, 'cart_table_show_data'])->name('cart_table');

Route::get('/registration', [CustomerController::class, 'index'])->name('registration');
Route::post('/submitUser', [CustomerController::class, 'submitUser'])->name('submitUser');
Route::get('/loginUser', [CustomerController::class, 'loginUser'])->name('loginUser');
Route::post('/submitLoginUser', [CustomerController::class, 'submitLoginUser'])->name('submitLoginUser');
Route::get('/forget_password', [CustomerController::class, 'forget_password'])->name('forget_password');
Route::post('/postforget_password', [CustomerController::class, 'postforget_password'])->name('postforget_password');
Route::get('/reset_password/{token}', [CustomerController::class, 'reset_password'])->name('reset_password');
Route::post('/postreset_password', [CustomerController::class, 'postreset_password'])->name('postreset_password');
Route::group(['prefix' => 'user', 'middleware' => 'customer_auth'], function () {
	Route::get('/userProfile', [CustomerController::class, 'userProfile'])->name('userProfile');
	Route::post('/postuserProfile', [CustomerController::class, 'postuserProfile'])->name('postuserProfile');
	Route::get('/user_ChangePassword', [CustomerController::class, 'user_ChangePassword'])->name('user_ChangePassword');
	Route::post('/postuser_ChangePassword', [CustomerController::class, 'postuser_ChangePassword'])->name('postuser_ChangePassword');
	Route::get('/user_order', [CustomerController::class, 'user_order'])->name('user_order');
	Route::get('/user_favourites', [CustomerController::class, 'user_favourites'])->name('user_favourites');

	Route::get('/front_logout', [CustomerController::class, 'front_logout'])->name('front_logout');
});
//Admin Module

Route::get('/admin', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.post');
// apply midddleware
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
	Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::get('/changepassword', [AuthController::class, 'ChangePassword'])->name('chagepassword');
	Route::post('/changepassword', [AuthController::class, 'ChangePasswordSubmit'])->name('chagepassword.post');
	Route::get('/changeprofile', [AuthController::class, 'ChangeProfile'])->name('change-profile');
	Route::post('/changeprofile', [AuthController::class, 'ChangeProfileStore'])->name('change-profile-post');

	// customer management routes
	Route::get('/userlist', [UserController::class, 'Userlist'])->name('userlist');
	Route::get('/get-userlist', [UserController::class, 'GetUsers'])->name('get-userlist');
	Route::get('/add-customer', [UserController::class, 'AddCustomer'])->name('add-customer');
	Route::post('/add-customer', [UserController::class, 'AddCustomerPost'])->name('add-customer.post');
	Route::get('/edit-customer/{id}', [UserController::class, 'EditUser'])->name('edit-customer');
	Route::post('/edit-customer/{id}', [UserController::class, 'UpdateCustomer'])->name('edit-customer-post');
	Route::get('/delete-customer/{id}', [UserController::class, 'deleteCustomer'])->name('delete-customer-post');
	Route::post('/user-status-change',[UserController::class,'User_status_change'])->name('user.status.change');


	// card management routes
	Route::get('/cardlist', [CardController::class, 'index'])->name('cardlist');
	Route::get('/create-card', [CardController::class, 'create'])->name('create.card');
	Route::post('/create-card', [CardController::class, 'store'])->name('create.card.post');
	Route::get('/getcardlist', [CardController::class, 'getCardlist'])->name('get.cardlist');
	Route::get('/editcard/{id}', [CardController::class, 'edit'])->name('edit.card');
	Route::post('/editcard/{id}', [CardController::class, 'update'])->name('edit.card.post');
	Route::post('/delete-card', [CardController::class, 'destroy'])->name('delete.card.post');
	Route::get('/viewcard/{id}', [CardController::class, 'show'])->name('view.card');
	Route::get('/delete_card_images/{id}', [CardController::class, 'card_gallery_delete'])->name('delete-card-images');
	Route::post('/status-change12', [CardController::class, 'Status_change'])->name('status.change');


	//message management routes
	Route::get('/textmessagelist', [MessageController::class, 'index'])->name('messagelist');
	Route::get('/create-message', [MessageController::class, 'create'])->name('create.message');
	Route::post('/create-message', [MessageController::class, 'store'])->name('create.message.post');
	Route::get('/getmessagelist', [MessageController::class, 'getTextmessagelist'])->name('get.messagelist');
	Route::get('/edittextmessage/{id}', [MessageController::class, 'edit'])->name('edit.message');
	Route::post('/edittextmessage/{id}', [MessageController::class, 'update'])->name('edit.message.post');
	Route::post('/delete-message', [MessageController::class, 'destroy'])->name('delete.message.post');
	Route::post('/mess-status-change',[MessageController::class,'Mess_status_change'])->name('mess.status.change');



	//text font management routes
	Route::get('/textfontlist', [CustomTextController::class, 'textfontlist'])->name('textfontlist');
	Route::get('/create-text-font', [CustomTextController::class, 'createtextfont'])->name('create.textfont');
	Route::post('/create-text-font', [CustomTextController::class, 'storetextfont'])->name('create.textfont.post');
	Route::get('/gettextfontlist', [CustomTextController::class, 'getTextfontlist'])->name('get.textfontlist');
	Route::get('/edittextfont/{id}', [CustomTextController::class, 'edittextfont'])->name('edit.textfont');
	Route::post('/edittextfont/{id}', [CustomTextController::class, 'updatetextfont'])->name('edit.textfont.post');
	Route::post('/delete-text-font', [CustomTextController::class, 'destroytextfont'])->name('delete.textfont.post');

	//text size management routes
	Route::get('/textsizelist', [CustomTextController::class, 'textsizelist'])->name('textsizelist');
	Route::get('/create-text-size', [CustomTextController::class, 'createtextsize'])->name('create.textsize');
	Route::post('/create-text-size', [CustomTextController::class, 'storetextsize'])->name('create.textsize.post');
	Route::get('/gettextsizelist', [CustomTextController::class, 'getTextsizelist'])->name('get.textsizelist');
	Route::get('/edittextsize/{id}', [CustomTextController::class, 'edittextsize'])->name('edit.textsize');
	Route::post('/edittextsize/{id}', [CustomTextController::class, 'updatetextsize'])->name('edit.textsize.post');
	Route::post('/delete-text-size', [CustomTextController::class, 'destroytextsize'])->name('delete.textsize.post');

	//text color management routes
	Route::get('/textcolorlist', [CustomTextController::class, 'textcolorlist'])->name('textcolorlist');
	Route::get('/create-text-color', [CustomTextController::class, 'createtextcolor'])->name('create.textcolor');
	Route::post('/create-text-color', [CustomTextController::class, 'storetextcolor'])->name('create.textcolor.post');
	Route::get('/gettextcolorlist', [CustomTextController::class, 'getTextcolorlist'])->name('get.textcolorlist');
	Route::get('/edittextcolor/{id}', [CustomTextController::class, 'edittextcolor'])->name('edit.textcolor');
	Route::post('/edittextcolor/{id}', [CustomTextController::class, 'updatetextcolor'])->name('edit.textcolor.post');
	Route::post('/delete-text-color', [CustomTextController::class, 'destroytextcolor'])->name('delete.textcolor.post');


	// card category management
	Route::get('/cardcategorylist', [CategoryController::class, 'index'])->name('categorylist');
	Route::get('/create-category', [CategoryController::class, 'create'])->name('create.category');
	Route::post('/create-category', [CategoryController::class, 'store'])->name('create.category.post');
	Route::get('/getcategorylist', [CategoryController::class, 'getCategorylist'])->name('get.categorylist');
	Route::get('/edit-card-category/{id}', [CategoryController::class, 'show'])->name('edit.category');
	Route::post('/edit-card-category/{id}', [CategoryController::class, 'edit'])->name('edit.category.post');
	Route::post('/delete-category', [CategoryController::class, 'destroy'])->name('delete.category.post');

	//card size management
	Route::get('/card-size-list', [CardSizeController::class, 'index'])->name('cardsizelist');
	Route::get('/create-card_size', [CardSizeController::class, 'create'])->name('create.card.size');
	Route::post('/create-card_size', [CardSizeController::class, 'store'])->name('create.card.size.post');
	Route::get('/getcardsizelist', [CardSizeController::class, 'getCardSizelist'])->name('get.cardsizelist');
	Route::post('/delete-card-size', [CardSizeController::class, 'destroy'])->name('delete.card.size.post');
	Route::get('/edit-card-size/{id}', [CardSizeController::class, 'edit'])->name('edit.card.size');
    Route::post('/edit-card-size/{id}', [CardSizeController::class, 'update'])->name('edit.card.size.post');

	// Content management Routes
	Route::get('/content-pagelist', [AdminPagesController::class, 'index'])->name('content-pagelist');
	Route::get('/create-new-page', [AdminPagesController::class, 'create'])->name('create.new.page');
	Route::post('/create-new-page', [AdminPagesController::class, 'store'])->name('create.new.page.post');
	Route::get('/getpagelist', [AdminPagesController::class, 'getPagelist'])->name('get.pagelist');
	Route::get('/edit-page/{id}', [AdminPagesController::class, 'edit'])->name('edit.page');
	Route::post('/edit-page/{id}', [AdminPagesController::class, 'update'])->name('edit.page.post');
	Route::post('/delete-page', [AdminPagesController::class, 'destroy'])->name('delete.page.post');
	Route::post('/content-page-status-change',[AdminPagesController::class,'contentp_status_change'])->name('content.page.status.change');

	// card sub category management routes
	Route::get('/cardsubcategorylist/{subcatid}', [SubCategoryController::class, 'index'])->name('subcategorylist');
	Route::get('/create-sub-category/{subcatid}', [SubCategoryController::class, 'create'])->name('create.sub.category');
	Route::post('/create-sub-category/{subcatid}', [SubCategoryController::class, 'store'])->name('create.sub.category.post');
	Route::get('/getsubcategorylist/{subcatid}', [SubCategoryController::class, 'getSubCategorylist'])->name('get.subcategorylist');
	Route::get('/edit-card-subcategory/{id}', [SubCategoryController::class, 'edit'])->name('edit.sub.category');
    Route::post('/edit-card-subcategory/{id}', [SubCategoryController::class, 'update'])->name('edit.sub.category.post');
	Route::post('/delete-sub-category', [SubCategoryController::class, 'destroy'])->name('delete.sub.category.post');

	//Fourite Cards Routes
	Route::get('/favourite-card-list', [FavouriteCardsController::class, 'index'])->name('favorite-card-list');
	Route::get('/getfavouritecardlist', [FavouriteCardsController::class, 'getfavouritecardist'])->name('get.favouritecardlist');
	Route::post('/delete-favourite-card', [FavouriteCardsController::class, 'destroy'])->name('delete.fav.card.post');

	// Booking Management routes
	Route::get('/order-list', [OrderController::class, 'index'])->name('order-list');
	Route::get('/getOrderlist', [OrderController::class, 'getOrderList'])->name('get.orderlist');
	Route::get('/order-details/{id}', [OrderController::class, 'show'])->name('order-detail');
	Route::post('/orderstatuschange',[OrderController::class,'OrderstatusChange'])->name('order.status.change');

	//Voucher Code routes
	Route::get('/voucher-code-list', [VoucherCodeController::class, 'index'])->name('vouchercodelist');
	Route::get('/getvouchercodelist', [VoucherCodeController::class, 'GetVoucherCodeList'])->name('get.vouchercodelist');
	Route::get('/create-voucher-code', [VoucherCodeController::class, 'create'])->name('create.voucher.code');
    Route::post('/create-voucher-code', [VoucherCodeController::class, 'store'])->name('create.voucher.code.post');
	Route::get('/edit-voucher-code/{id}', [VoucherCodeController::class, 'edit'])->name('edit.voucher.code');
	Route::post('/edit-voucher-code/{id}', [VoucherCodeController::class, 'update'])->name('edit.voucher.code.post');
	Route::post('/delete-voucher-code', [VoucherCodeController::class, 'destroy'])->name('delete.voucher.code');
	Route::post('/voucher-code-status-change',[VoucherCodeController::class,'VoucherStatusChange'])->name('voucher.code.status.change');

	//payment history routes
	Route::get('/payment-list', [PaymentController::class, 'index'])->name('paymentlist');
	Route::get('/getpaymenttranslist', [PaymentController::class, 'GetPaymentTranslist'])->name('get.paymentranstlist');
    Route::get('/view-payment-detail/{id}', [PaymentController::class, 'show'])->name('view.payment.detail');


});
