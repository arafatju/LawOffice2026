<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\hhomeController;
use App\Http\Controllers\infoimp;
use App\Http\Controllers\test;

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

Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:userdr'])->group(function () {
    Route::get('/userstatus22/{id}', [infoimp::class, 'userstatus22'])->name('userstatus22'); 
    

    Route::get('/showinactive', [infoimp::class, 'showinactive'])->name('showinactive'); 

    Route::get('/userlist1122', [infoimp::class, 'userlist1122'])->name('userlist1122'); 
    
    Route::get('/inactiveuserlist/{id}', [infoimp::class, 'inactiveuserlist'])->name('inactiveuserlist'); 


    Route::post('/finalstage1123', [infoimp::class, 'finalstage1123'])->name('finalstage1123'); 

    Route::get('/finalstage1122', [infoimp::class, 'finalstage1122'])->name('finalstage1122'); 
    Route::get('/acceptfinal/{id}', [infoimp::class, 'acceptfinal'])->name('acceptfinal'); 
    Route::get('/budgetback11/{id}', [infoimp::class, 'budgetback11'])->name('budgetback11'); 

    Route::get('/dash2', [infoimp::class, 'dash2'])->name('dash2'); 
    Route::get('/finaluser', [infoimp::class, 'finaluser'])->name('finaluser');
    Route::get('/dashboard', [infoimp::class, 'dashboard'])->name('dashboard'); 
    
    Route::get('/user', [infoimp::class, 'user'])->name('user'); 
     Route::post('/draftdetails', [infoimp::class, 'draftdetails'])->name('draftdetails'); 
    
    Route::get('/finalchange', [infoimp::class, 'finalchange'])->name('finalchange'); 
    
    Route::get('/dataone', [infoimp::class, 'dataone'])->name('dataone'); 
    
       Route::get('/userstatus', [infoimp::class, 'userstatus'])->name('userstatus'); 
     
       
       Route::get('/finalstage', [infoimp::class, 'finalstage'])->name('finalstage'); 
       Route::get('/overalldel11/{id}/{name}', [infoimp::class, 'overalldel11'])->name('overalldel11'); 

       
});

Route::middleware(['auth', 'user-access:usersr'])->group(function () {
    Route::get('/srdel/{name}/{id}', [infoimp::class, 'srdel'])->name('srdel'); 
    Route::get('/budgetstatusfinal1/{id}', [infoimp::class, 'budgetstatusfinal1'])->name('budgetstatusfinal1'); 
    
    Route::get('/budgetback/{id}', [infoimp::class, 'budgetback'])->name('budgetback'); 

    Route::get('/overalldel/{id}/{name}', [infoimp::class, 'overalldel'])->name('overalldel'); 

    Route::get('/verificationinfo', [infoimp::class, 'verificationinfo'])->name('verificationinfo'); 

     Route::get('/finacialcode', [infoimp::class, 'finacialcode'])->name('finacialcode'); 

    Route::post('/budgetcode', [infoimp::class, 'budgetcode'])->name('budgetcode'); 

    Route::get('/section7', [infoimp::class, 'section7'])->name('section7'); 
    Route::get('/usersr', [infoimp::class, 'usersr'])->name('usersr'); 
     
 
       Route::get('/deletesr', [infoimp::class, 'deletesr'])->name('deletesr'); 
    Route::get('/sendtoict', [infoimp::class, 'sendtoict'])->name('sendtoict'); 
     Route::get('/srloguser', [infoimp::class, 'srloguser'])->name('srloguser'); 
    Route::get('/adminstatus', [infoimp::class, 'adminstatus'])->name('adminstatus'); 
     
    Route::get('/userstatus11/{id}', [infoimp::class, 'userstatus11'])->name('userstatus11'); 


});

Route::middleware(['auth', 'user-access:useradmin'])->group(function () {
    Route::get('/userinfo', [infoimp::class, 'userinfo'])->name('userinfo'); 
     Route::get('/loguser', [infoimp::class, 'loguser'])->name('loguser'); 
    Route::get('/userinfo', [infoimp::class, 'userinfo'])->name('userinfo'); 
    
    Route::get('/pendinguser', [infoimp::class, 'pendinguser'])->name('pendinguser'); 

    Route::get('/deluser/{id}', [infoimp::class, 'deluser'])->name('deluser'); 
    Route::get('/allpic', [infoimp::class, 'allpic'])->name('allpic'); 


});

Route::middleware(['auth', 'user-access:user'])->group(function () {
   Route::get('/Newuser', [infoimp::class, 'Newuser'])->name('Newuser'); 

});
Route::middleware(['auth', 'user-access:userone'])->group(function () {
    
    Route::get('/spouse', [infoimp::class, 'spouse'])->name('spouse');
    Route::get('/budgetstatus/{id}', [infoimp::class, 'budgetstatus'])->name('budgetstatus');

    Route::post('/budgetform', [infoimp::class, 'budgetform'])->name('budgetform'); 
    Route::get('/jobinfo', [infoimp::class, 'jobinfo'])->name('jobinfo');
    
    Route::get('/userbudgetdel/{id}', [infoimp::class, 'userbudgetdel'])->name('userbudgetdel');


});