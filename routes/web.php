<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaypalController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlertController;

// User Routes

Route::get('/',[UserController::class,'index'])->name('home');

Route::get('/product/{slug}/{id}',[UserController::class,'productDetails'])->name('productDetails');
Route::get('search{search?}',[UserController::class,'search'])->name('search');
Route::get('/category/{categorySlug}/{subCategorySlug?}',[UserController::class,'productBycategory'])->name('productBycategory');
Route::get('/add-to-cart',[UserController::class,'showAddToCartPage'])->name('AddToCartPage');
Route::get('/checkout',[UserController::class,'showCheckoutPage'])->name('showCheckoutPage');

Route::post('paypal',[PaypalController::class,'paypal'])->name('paypal');
Route::get('success',[PaypalController::class,'success'])->name('success');
Route::get('cancel',[PaypalController::class,'cancel'])->name('cancel');

Route::get('/thank-you',[UserController::class,'showThankYouPage'])->name('showThankYouPage');
Route::get('/orders',[OrderController::class,'showMyOrdersPage'])->name('showMyOrdersPage');
Route::get('/order/{id}',[OrderController::class,'showMyOrdersDetails'])->name('showMyOrdersDetails');

Route::get('/user/profile',[UserController::class,'showProfilePage'])->name('showProfilePage');
Route::post('/user/profile',[UserController::class,'profileUpdate'])->name('profileUpdate');
Route::get('/user/change-password',[UserController::class,'showChangePassPage'])->name('showChangePassPage');
Route::post('/user/change-password',[UserController::class,'changePassPage'])->name('changePassPage');

// Authentication
Route::get('/Sign-Up',[AuthController::class,'showRegistration'])->name('auth.sign-up');
Route::get('/Login',[AuthController::class,'showLogin'])->name('auth.login');





Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');

Route::get('/admin/category/create',[AdminController::class,'showAddCategoryPage'])->name('addCategory');
Route::post('/admin/category/create',[AdminController::class,'addCategory']);

Route::get('/admin/category/all',[AdminController::class,'allCategory'])->name('allCategory');

Route::get('/admin/category/delete/{id}',[AdminController::class,'deleteCategory'])->name('deleteCategory');

Route::get('/admin/product/create',[AdminController::class,'showAddProductPage'])->name('showAddProductPage');
Route::post('/admin/product/create',[AdminController::class,'addProduct'])->name('addProduct');

Route::get('/admin/product/all',[AdminController::class,'allProduct'])->name('allProduct');
Route::get('/admin/product/edit/{id}',[AdminController::class,'showEditProduct'])->name('showEditProduct');
Route::post('/admin/product/edit/{id}',[AdminController::class,'editProduct'])->name('editProduct');
Route::get('/admin/product/delete/{id}',[AdminController::class,'deleteProduct'])->name('deleteProduct');

Route::get('/admin/orders/all',[OrderController::class,'showAllOrder'])->name('showAllOrder');
Route::get('/admin/orders/order/{id}',[OrderController::class,'showOrderDetails'])->name('showOrderDetails');
Route::post('/admin/orders/order/{id}/mark-order',[OrderController::class,'markOrder'])->name('markOrder');

Route::get('/admin/orders/invoice/{id}',[OrderController::class,'showOrderInvoice'])->name('showOrderInvoice');
Route::get('/admin/orders/invoice/{id}/generate',[OrderController::class,'InvoiceDownload'])->name('InvoiceDownload');

Route::get('/admin/profile',[AdminController::class,'showProfilePage'])->name('showAdminProfilePage');
Route::post('/admin/profile',[AdminController::class,'profileUpdate'])->name('profileAdminUpdate');
Route::get('/admin/change-password',[AdminController::class,'showChangePassPage'])->name('showAdminChangePassPage');
Route::post('/admin/change-password',[AdminController::class,'changePassPage'])->name('changeAdminPassPage');

Route::get('/admin/notification',[AlertController::class,'index']);
Route::post('/admin/notification/create',[AlertController::class,'store']);
Route::get('/admin/notification/mark-as-read',[AlertController::class,'markAsRead'])->name('mark-as-read');

Route::get('/Logout',function()
{
    Auth::logout();
    session()->flush();
    return redirect('/');
});




