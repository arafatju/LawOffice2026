<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\hhomeController;
use App\Http\Controllers\infoimp;
use App\Http\Controllers\test;
use App\Http\Controllers\Storeuser;
use App\Http\Controllers\notaryadmin;
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

Route::get('/', function () {
    return view('auth.login');
});
 
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify'=>false,
    'resend'=>false,
]);
 
 Route::get('/login', [App\Http\Controllers\infoimp::class, 'index'])->name('login');
Route::get('/registration', [App\Http\Controllers\test::class, 'registration'])->name('registration');

 
 Route::post('/custom-login', [test::class, 'customLogin'])->name('login.custom'); 
 Route::post('/custom-registration', [test::class, 'customRegistration'])->name('register.custom'); 
Route::get('/signout', [infoimp::class, 'signOut'])->name('signout');
Route::get('/forget11', [test::class, 'forget11'])->name('forget11'); 
Route::post('/forget22', [test::class, 'forget22'])->name('forget22'); 
Route::post('/forget33', [test::class, 'forget33'])->name('forget33'); 
Route::post('/forget44', [test::class, 'forget44'])->name('forget44'); 



Route::get('/result123', [infoimp::class, 'result123'])->name('result123'); 


Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/ 

Route::middleware(['auth', 'user-access:userdr'])->group(function () {
    Route::get('/device.register', [infoimp::class, 'deviceregister'])->name('device.register'); 
    Route::get('/sendotp', [infoimp::class, 'sendotp'])->name('sendotp'); 
    Route::get('/special11', [infoimp::class, 'special11'])->name('special11'); 

 
});
 
Route::middleware(['auth', 'user-access:useradmin'])->group(function () {
        
Route::put('/allotments/{prcode}', [Storeuser::class, 'updateByPrcode'])->name('allotments.updateByPrcode');

 Route::put('/products/{prcode}/quantity', [Storeuser::class, 'updateQuantity'])->name('products.updateQuantity');
 
Route::get('/allotments/{prcode}', [Storeuser::class, 'getByPrcode'])->name('allotments.byPrcode');

Route::delete('/delete/{type}/{prcode}', [Storeuser::class, 'destroyByType'])->name('delete.bytype');

    Route::post('/product/store', [Storeuser::class, 'store'])->name('product.store');

    Route::get('/StoreDashboard', [Storeuser::class, 'StoreDashboard'])->name('StoreDashboard');
    Route::get('/product', [Storeuser::class, 'product'])->name('product');
    Route::get('/user11', [Storeuser::class, 'user11'])->name('user11');
        Route::get('/admin11', [Storeuser::class, 'admin11'])->name('admin11');
             Route::get('/accpeted11', [Storeuser::class, 'accepted11'])->name('accepted11');
  
Route::delete('/users/{id}', [Storeuser::class, 'destroyuser'])->name('users.destroy');
 
Route::put('/users/{id}/role', [Storeuser::class, 'updateRole'])->name('users.updateRole');

 

Route::post('/users/password-update', [Storeuser::class, 'updatePassword'])->name('users.password.update');

Route::get('/productpending/{id}', [Storeuser::class, 'productpending'])->name('productpending');

 Route::put('/edit-profile/{id}', [Storeuser::class, 'updateUserProfile'])->name('users.update.profile');

 Route::get('/edit112/{id}', [Storeuser::class, 'edit112'])->name('edit112');
Route::put('/profile/update', [Storeuser::class, 'update112'])->name('profile.update');
Route::post('/transactions/{id}/approve', [Storeuser::class, 'approve'])->name('transactions.approve');
Route::delete('/transactions/{id}', [Storeuser::class, 'destroy'])->name('transactions.delete');
Route::put('/users/{id}/change-password', [Storeuser::class, 'changePassword'])->name('user.change.password');
Route::get('/productpending21', [Storeuser::class, 'productpending21'])->name('productpending21');

Route::post('/transactions/approve-multiple', [Storeuser::class, 'approveMultiple'])->name('transactions.approveMultiple');

Route::get('/report111', [Storeuser::class, 'report111'])->name('report111');

});


Route::middleware(['auth', 'user-access:userone'])->group(function () {
Route::get('/userdash', [Storeuser::class, 'userdash'])->name('userdash');
    Route::get('/userapprovedlist', [Storeuser::class, 'userapprovedlist'])->name('userapprovedlist');
    Route::get('/userpending', [Storeuser::class, 'userpending'])->name('userpending');
    Route::get('/userprofile', [Storeuser::class, 'userprofile'])->name('userprofile');
    Route::get('/userreport', [Storeuser::class, 'userreport'])->name('userreport');


Route::get('/products-by-category/{category}', [Storeuser::class, 'getProductsByCategory']);
Route::get('/product-quantity/{prcode}', [Storeuser::class, 'getProductQuantity']);
Route::post('/save-draft', [Storeuser::class, 'saveDraft']);
Route::post('/submit-product', [Storeuser::class, 'submitProduct']);

    });