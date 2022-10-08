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
    return view('nav1');
});

Route::get('/bivag/{id}', [App\Http\Controllers\hhomeController::class, 'bivag'])->name('bivag');
Route::get('/hhome', [App\Http\Controllers\hhomeController::class, 'index'])->name('hhome');
Route::post('/jela', [App\Http\Controllers\hhomeController::class, 'jela'])->name('jela');
Route::get('/upojela/{jela}', [App\Http\Controllers\hhomeController::class, 'upojela'])->name('upojela');
Route::get('/union123/{thana}', [App\Http\Controllers\hhomeController::class, 'union123'])->name('union123');
Route::get('/person/{odhikhetro}', [App\Http\Controllers\hhomeController::class, 'person'])->name('person');
Route::get('/pourosova/{jela}', [App\Http\Controllers\hhomeController::class, 'pourosova'])->name('pourosova');
Route::get('/ward123/{pourosova}', [App\Http\Controllers\hhomeController::class, 'ward123'])->name('ward123');
Route::get('/person2/{odhikhetro}', [App\Http\Controllers\hhomeController::class, 'person2'])->name('person2');
Route::get('/city', [App\Http\Controllers\hhomeController::class, 'city'])->name('city');
Route::post('/cityward', [App\Http\Controllers\hhomeController::class, 'cityward'])->name('cityward');
Route::get('/person3/{odhikhetro}', [App\Http\Controllers\hhomeController::class, 'person3'])->name('person3');
Route::get('/onu', [App\Http\Controllers\hhomeController::class, 'onu'])->name('onu');
Route::post('/onujela', [App\Http\Controllers\OnuController::class, 'onujela'])->name('onujela');
Route::post('/onuupojela', [App\Http\Controllers\OnuController::class, 'onuupojela'])->name('onuupojela');
Route::post('/onupourosova', [App\Http\Controllers\OnuController::class, 'onuupourosova'])->name('onupourosova');
Route::post('/onucity', [App\Http\Controllers\OnuController::class, 'onucity'])->name('onucity');
Route::post('/onuunion', [App\Http\Controllers\OnuController::class, 'onuunion'])->name('onuunion');
Route::post('/onuward', [App\Http\Controllers\OnuController::class, 'onuward'])->name('onuward');
Route::post('/onucityward', [App\Http\Controllers\OnuController::class, 'onucityward'])->name('onucityward');
Route::post('/onuperson1', [App\Http\Controllers\OnuController::class, 'onuperson1'])->name('onuperson1');
Route::post('/onuperson2', [App\Http\Controllers\OnuController::class, 'onuperson2'])->name('onuperson2');
Route::post('/onuperson3', [App\Http\Controllers\OnuController::class, 'onuperson3'])->name('onuperson3');
Route::get('/stat', [App\Http\Controllers\CountryController::class, 'stat'])->name('stat');
Route::get('/motamot', [App\Http\Controllers\CountryController::class, 'motamot'])->name('motamot');
Route::get('/details', [App\Http\Controllers\CountryController::class, 'details'])->name('details');

 Route::get('/login', [App\Http\Controllers\infoimp::class, 'index'])->name('login');
Route::get('/registration', [App\Http\Controllers\test::class, 'registration'])->name('registration');

 Route::post('/custom-login', [test::class, 'customLogin'])->name('login.custom'); 
 Route::post('/custom-registration', [test::class, 'customRegistration'])->name('register.custom'); 
Route::get('/signout', [infoimp::class, 'signOut'])->name('signout');

Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:userdr'])->group(function () {
  
    Route::get('/dashboard', [infoimp::class, 'dashboard'])->name('dashboard'); 
    Route::post('/profile', [infoimp::class, 'profile'])->name('profile'); 
    Route::get('/picturekazi/{id}', [infoimp::class, 'picturekazi'])->name('picturekazi'); 

    Route::get('/user', [infoimp::class, 'user'])->name('user'); 
    Route::get('/okchange', [infoimp::class, 'okchange'])->name('okchange'); 
    Route::get('/editchange/{id}', [infoimp::class, 'editchange'])->name('editchange'); 
    Route::get('/changeme/{id}/{id2}', [infoimp::class, 'changeme'])->name('changeme'); 
    Route::post('/draftdetails', [infoimp::class, 'draftdetails'])->name('draftdetails'); 
    
    Route::get('/finalchange', [infoimp::class, 'finalchange'])->name('finalchange'); 
    
    Route::get('/dataone', [infoimp::class, 'dataone'])->name('dataone'); 
    Route::get('/deleteme/{id}', [infoimp::class, 'deleteme'])->name('deleteme'); 
    Route::get('/showkazi', [infoimp::class, 'showkazi'])->name('showkazi'); 
    
    Route::post('/changepicture', [infoimp::class, 'changepicture'])->name('changepicture'); 
    Route::get('/changepicturekazi/{id}', [infoimp::class, 'changepicturekazi'])->name('changepicturekazi'); 
    Route::post('/updatepicturekazi', [infoimp::class, 'updatepicturekazi'])->name('updatepicturekazi'); 
    Route::get('/delchange/{id}', [infoimp::class, 'delchange'])->name('delchange'); 
    Route::get('/deliddr/{id}', [infoimp::class, 'deliddr'])->name('deliddr'); 
    
    Route::get('/delsend/{id}', [infoimp::class, 'delsend'])->name('delsend'); 
    Route::post('/statusdel', [infoimp::class, 'statusdel'])->name('statusdel'); 
    Route::get('/deldashboard', [infoimp::class, 'deldashboard'])->name('deldashboard'); 
    Route::get('/addlcharge/{id}', [infoimp::class, 'addlcharge'])->name('addlcharge'); 
    Route::post('/addlduty', [infoimp::class, 'addlduty'])->name('addlduty'); 
        
    Route::get('/delicharge/{id}', [infoimp::class, 'delicharge'])->name('delicharge'); 
    Route::get('/chargesend/{id}', [infoimp::class, 'chargesend'])->name('chargesend'); 

    Route::get('/chargedash', [infoimp::class, 'chargedash'])->name('chargedash'); 
    Route::get('/beforedata', [infoimp::class, 'beforedata'])->name('beforedata'); 

    Route::post('/notuninfo', [infoimp::class, 'notuninfo'])->name('notuninfo'); 
    Route::get('/notundashboard', [infoimp::class, 'notundashboard'])->name('notundashboard'); 
    Route::get('/delnotun/{id}', [infoimp::class, 'delnotun'])->name('delnotun'); 
    Route::get('/sendnotun/{id}', [infoimp::class, 'sendnotun'])->name('sendnotun'); 
    Route::get('/viewnotun/{id}', [infoimp::class, 'viewnotun'])->name('viewnotun'); 
    Route::get('/notun', [infoimp::class, 'notun'])->name('notun'); 


});

Route::middleware(['auth', 'user-access:usersr'])->group(function () {
  
    Route::get('/section7', [infoimp::class, 'section7'])->name('section7'); 
    Route::get('/usersr', [infoimp::class, 'usersr'])->name('usersr'); 
    Route::post('/profilesr', [infoimp::class, 'profilesr'])->name('profilesr'); 
    
    Route::get('/verifychange', [infoimp::class, 'verifychange'])->name('verifychange'); 


});