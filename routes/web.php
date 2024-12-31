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



Route::get('/result123', [infoimp::class, 'result123'])->name('result123'); 


Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:userdr'])->group(function () {
   // Route::get('/userstatus22/{id}', [infoimp::class, 'userstatus22'])->name('userstatus22'); 
    Route::post('userdelete11/{userId}', [infoimp::class, 'userdelete11'])->name('userdelete11');
Route::post('userchangepassword11/{id} ', [infoimp::class, 'userchangepassword11'])->name('userchangepassword11');
Route::post('userchangeemail11/{id} ', [infoimp::class, 'userchangeemail11'])->name('userchangeemail11');
Route::get('/usermanagement', [infoimp::class, 'usermanagement'])->name('usermanagement');
Route::get('/datasheet3', [infoimp::class, 'getData3'])->name('datasheet3');
Route::get('/addoffice', [infoimp::class, 'addoffice'])->name('addoffice');
Route::get('/office2', [infoimp::class, 'office2'])->name('office2');
Route::post('doptordelete11/{userId}', [infoimp::class, 'doptordelete11'])->name('doptordelete11');
Route::post('/office3', [infoimp::class, 'office3'])->name('office3');
Route::get('/emaildash1', [infoimp::class, 'emaildash1'])->name('emaildash1');
Route::get('/emaildashboard', [infoimp::class, 'emaildashboard'])->name('emaildashboard');

Route::get('/loginfo111', [infoimp::class, 'loginfo111'])->name('loginfo111');
Route::get('/log112', [infoimp::class, 'log112'])->name('log112');

Route::get('/userpdf111/{userId}', [infoimp::class, 'userpdf111'])->name('userpdf111');
    Route::get('/datasheet', [infoimp::class, 'getData'])->name('datasheet');
    Route::get('/datasheet2', [infoimp::class, 'get2data'])->name('datasheet2');
    Route::get('/newdash', [infoimp::class, 'newdash'])->name('newdash');

   // Route::get('/showinactive', [infoimp::class, 'showinactive'])->name('showinactive'); 

    Route::get('/userlist1122', [infoimp::class, 'userlist1122'])->name('userlist1122'); 
    
   // Route::get('/inactiveuserlist/{id}', [infoimp::class, 'inactiveuserlist'])->name('inactiveuserlist'); 


   // Route::post('/finalstage1123', [infoimp::class, 'finalstage1123'])->name('finalstage1123'); 

    //Route::get('/finalstage1122', [infoimp::class, 'finalstage1122'])->name('finalstage1122'); 
    //Route::get('/acceptfinal/{id}', [infoimp::class, 'acceptfinal'])->name('acceptfinal'); 
  //  Route::get('/budgetback11/{id}', [infoimp::class, 'budgetback11'])->name('budgetback11'); 

    Route::get('/dash2', [infoimp::class, 'dash2'])->name('dash2'); 
   // Route::get('/finaluser', [infoimp::class, 'finaluser'])->name('finaluser');
    Route::get('/dashboard', [infoimp::class, 'dashboard'])->name('dashboard'); 
    
    Route::get('/user', [infoimp::class, 'user'])->name('user'); 
     Route::post('/draftdetails', [infoimp::class, 'draftdetails'])->name('draftdetails'); 
    
    Route::get('/finalchange', [infoimp::class, 'finalchange'])->name('finalchange'); 
    
    Route::get('/dataone', [infoimp::class, 'dataone'])->name('dataone'); 
    
       Route::get('/userstatus', [infoimp::class, 'userstatus'])->name('userstatus'); 
     
       
       //Route::get('/finalstage', [infoimp::class, 'finalstage'])->name('finalstage'); 
       Route::get('/overalldel11/{id}/{name}', [infoimp::class, 'overalldel11'])->name('overalldel11'); 

       
});

 
 
 
Route::middleware(['auth', 'user-access:userone'])->group(function () {
    Route::post('/release11', [infoimp::class, 'release11'])->name('release11'); 
    Route::get('/all_info', [infoimp::class, 'all_info'])->name('all_info'); 
    Route::get('/releasefromcurrent', [infoimp::class, 'releasefromcurrent'])->name('releasefromcurrent');
    Route::get('/delete111/{id}', [infoimp::class, 'delete111'])->name('delete111');
    Route::get('/delete112/{id}', [infoimp::class, 'delete112'])->name('delete112');
    Route::get('/child12', [infoimp::class, 'child12'])->name('child12');
    Route::get('/distbefore', [infoimp::class, 'distbefore'])->name('distbefore');

    Route::get('/spouse', [infoimp::class, 'spouse'])->name('spouse');
    Route::get('/workplace', [infoimp::class, 'workplace'])->name('workplace');
   
    Route::post('/budgetform', [infoimp::class, 'budgetform'])->name('budgetform'); 
    Route::get('/jobinfo', [infoimp::class, 'jobinfo'])->name('jobinfo');
    Route::get('/editme/{tablename}/{rowname11}/{userid}', [infoimp::class, 'editme'])->name('editme'); 

    Route::get('/contactinfo', [infoimp::class, 'contactinfo'])->name('contactinfo');
    Route::get('/transferme', [infoimp::class, 'transferme'])->name('transferme');
    Route::post('/chakuri', [infoimp::class, 'chakuri'])->name('chakuri'); 
    
    Route::post('/married', [infoimp::class, 'married'])->name('married'); 
    Route::post('/husband', [infoimp::class, 'husband'])->name('husband'); 
    
    Route::post('/child11', [infoimp::class, 'child11'])->name('child11'); 
     
    Route::post('/workingpresent', [infoimp::class, 'workingpresent'])->name('workingpresent'); 
   
    Route::post('/workingbefore', [infoimp::class, 'workingbefore'])->name('workingbefore'); 
    Route::post('/contactinfo11', [infoimp::class, 'contactinfo11'])->name('contactinfo11'); 
    Route::post('/reason111', [infoimp::class, 'reason111'])->name('reason111'); 
    Route::get('/profile', [infoimp::class, 'profile'])->name('profile');
     

});