<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\hhomeController;
use App\Http\Controllers\infoimp;
use App\Http\Controllers\test;
use App\Http\Controllers\Storeuser;
use App\Http\Controllers\StoreSectionadmin;
use App\Http\Controllers\Storeentry;
use App\Http\Controllers\Pdfpermission111 ;
use App\Http\Controllers\Storeadminmonitor;
use App\Http\Controllers\notaryadmin;
 use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LogInfoController;
 use App\Http\Controllers\LotInfoController;



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

 
 Route::post('/custom-login', [test::class, 'customLogin'])->name('login.custom')->middleware('throttle:5,1');
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
    Route::get('/loginfo', [LogInfoController::class, 'index'])->name('loginfo.index');
Route::get('/loginfo/data', [LogInfoController::class, 'getData'])->name('loginfo.data');
 
    
    Route::get('/lots', [LotInfoController::class, 'index'])->name('lots.index');
Route::get('/lots/data', [LotInfoController::class, 'getData'])->name('lots.data');


    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/data', [TransactionController::class, 'getData'])->name('transactions.data');


     Route::put('/adminproduct/{prcode}/quantity', [Storeuser::class, 'updateQuantity'])->name('products.adminupdateQuantity');
    Route::get('/allotments/{prcode}', [Storeuser::class, 'getByPrcode'])->name('allotments.byPrcode');


Route::delete('/delete/{type}/{prcode}', [Storeuser::class, 'destroyByType'])->name('delete.bytype');

    Route::post('/product312', [Storeuser::class, 'product312'])->name('product312');

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



Route::middleware(['auth', 'user-access:usermonitor'])->group(function () {
      Route::get('/dash11', [Storeadminmonitor::class, 'dash11'])->name('dash11');
            Route::get('/productreport', [Storeadminmonitor::class, 'productreport'])->name('productreport');
            Route::get('/officereport', [Storeadminmonitor::class, 'officereport'])->name('officereport');
            Route::get('/report113', [Storeadminmonitor::class, 'report113'])->name('report113');

Route::get('/product-report', [Storeadminmonitor::class, 'prtreport111'])->name('product.report');
Route::get('/product-report/data', [Storeadminmonitor::class, 'getReportData'])->name('product.report.data');
Route::get('/productapproved111', [Pdfpermission111::class, 'productapproved111'])->name('productapproved111');
Route::get('/officereport1212', [Pdfpermission111::class, 'officereport1212'])->name('officereport1212');
Route::get('/userapproved111', [Pdfpermission111::class, 'userapproved111'])->name('userapproved111');
Route::get('/product2001', [Pdfpermission111::class, 'product2001'])->name('product2001');
Route::get('/product2002', [Pdfpermission111::class, 'product2002'])->name('product2002');
Route::get('/product2003', [Pdfpermission111::class, 'product2003'])->name('product2003');
Route::get('/product2004', [Pdfpermission111::class, 'product2004'])->name('product2004');
Route::get('/product2005', [Pdfpermission111::class, 'product2005'])->name('product2005');

    });

Route::middleware(['auth', 'user-access:userdataentry'])->group(function () {
Route::get('/datadash', [Storeentry::class, 'datadash'])->name('datadash');
Route::get('/datahistory', [Storeentry::class, 'datahistory'])->name('datahistory');
Route::get('/dataprofile', [Storeentry::class, 'dataprofile'])->name('dataprofile');
  Route::put('/allotments/{prcode}', [Storeentry::class, 'updateByPrcode111'])->name('allotments.updateByPrcode');
    Route::put('/products/{prcode}/quantity', [Storeentry::class, 'updateQuantity111'])->name('products.updateQuantity');
    Route::get('/allotments/{prcode}', [Storeentry::class, 'getByPrcode111'])->name('allotments.byPrcode');
Route::get('/datapending', [Storeentry::class, 'datapending'])->name('datapending');
Route::get('/dataapproved', [Storeentry::class, 'dataapproved'])->name('dataapproved');
Route::get('/productpending1124/{id}', [Storeentry::class, 'productpending1124'])->name('productpending1124');
Route::delete('/transactions/{id}', [Storeentry::class, 'destroy11'])->name('transactions.delete');
Route::post('/transactions11', [Storeentry::class, 'approveMultiple11'])->name('transactions.approveMultiple11');
Route::get('/officeapproved/{id}/{userid}', [Storeentry::class, 'officeapproved'])->name('officeapproved');
Route::get('/dataarchive', [Storeentry::class, 'dataarchive'])->name('dataarchive');
Route::get('/productapproved', [Storeentry::class, 'productapproved'])->name('productapproved');
Route::get('/officeapproved12/{id}/{userid}', [Storeentry::class, 'officeapproved12'])->name('officeapproved12');

    });


Route::middleware(['auth', 'user-access:usersectionadmin'])->group(function () {
Route::get('/datapending14', [Storesectionadmin::class, 'datapending14'])->name('datapending14');
Route::get('/productpending1135/{id}/{trid}', [Storesectionadmin::class, 'productpending1135'])->name('productpending1135');
Route::post('/transactions14', [Storesectionadmin::class, 'approveMultiple14'])->name('transactions.approveMultiple14');
Route::get('/dataapproved14', [Storesectionadmin::class, 'dataapproved14'])->name('dataapproved14');
Route::get('/dataprofile14', [Storesectionadmin::class, 'dataprofile14'])->name('dataprofile14');
Route::get('/officeapproved14/{id}/{userid}', [Storesectionadmin::class, 'officeapproved14'])->name('officeapproved14');

    Route::get('/section5', [Storesectionadmin::class, 'index'])->name('section5');
Route::delete('/transactions144/{id}', [Storesectionadmin::class, 'destroy122'])->name('transactions144.delete');
 Route::put('/allotments14/{prcode}', [Storesectionadmin::class, 'updateByPrcode114'])->name('allotments.updateByPrcode14');
    Route::put('/products14/{prcode}/quantity', [Storesectionadmin::class, 'updateQuantity114'])->name('products.updateQuantity14');
    Route::get('/allotments14/{prcode}', [Storesectionadmin::class, 'getByPrcode114'])->name('allotments.byPrcode14');
Route::get('/productapproved14', [Storesectionadmin::class, 'productapproved14'])->name('productapproved14');


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